<template>
  <div class='hello'>
    <h1>{{ msg }}</h1>
    <p>Total Hours: {{totalHours}}</p>
    <p>Total Reflections: {{records.length}}</p>
    <p>Total Events: {{eventList.length}}</p>
    <svg id="network" width="500" height="500"></svg>

  </div>
</template>

<script>
import 'amcharts3/amcharts/amcharts'
import 'amcharts3/amcharts/serial'
import 'amcharts3/amcharts/themes/light'
import * as d3 from 'd3'

export default {
  name: 'Index',
  data () {
    return {
      msg: 'Innovate LLP Analytics'
    }
  },
  computed: {
    records: function () {
      return this.$parent.records
    },
    totalHours: function () {
      if (this.$parent.records.length > 1) {
        let totalHours = this.records.reduce((accumulator, currentValue) => {
          return parseInt(accumulator) + parseInt(currentValue.eventHours)
        }, 0)
        return totalHours
      } else {
        return 0
      }
    },
    eventList: function () {
      let eventsList = this.records.map(function (record) {
        return record.eventTitle
      })

      function onlyUnique (value, index, self) {
        return self.indexOf(value) === index
      }
      eventsList = eventsList.filter(onlyUnique)
      return eventsList
    },
    networkStructure: function () {
      // This data structure will be built from this.records
      // since it caclulates the totality of the student interactions
      // Create our eventual final data structure
      let structure = {
        'nodes': [],
        'links': []
      }

      // Create a hash of user emails to use as id
      let nodeHash = {}
      this.$parent.records.forEach(record => {
        nodeHash[record.userEmail] =
        {
          id: record.userEmail,
          group: (!record.userMajor) ? 'N/A' : record.userMajor
        }
      })
      // Loop through nodeHash and push node object into array
      for (var prop in nodeHash) {
        structure.nodes.push(nodeHash[prop])
      }
      // Do something similar here to all of the events to calculate
      // links; Since we are analyzing coattendance at events, create
      // hashes for the individual event ID, then loop through them
      let eventHash = {}
      this.records.forEach(record => {
        if (eventHash[record.eventID]) {
          eventHash[record.eventID].push(record)
        } else {
          eventHash[record.eventID] = []
          eventHash[record.eventID].push(record)
        }
      })
      for (var event in eventHash) {
        var records = eventHash[event]
        records.sort(function (a, b) {
          var nameA = a.userEmail.toUpperCase() // ignore upper and lowercase
          var nameB = b.userEmail.toUpperCase() // ignore upper and lowercase
          if (nameA < nameB) {
            return -1
          }
          if (nameA > nameB) {
            return 1
          }
          // names must be equal
          return 0
        })

        let sortedArray = []
        records.forEach(record => {
          sortedArray.push(record.userEmail)
        })

        let uniqueArray = returnUnique(sortedArray)

        eventHash[event] = uniqueArray
      }

      function returnUnique (arr) {
        let seen = {}
        return arr.filter(item => {
          return seen.hasOwnProperty(item) ? false : (seen[item] = true)
        })
      }

      let linkHash = {}

      for (let event in eventHash) {
        let records = eventHash[event]
        for (var i = 0; i < records.length; i++) {
          if (!linkHash[records[i]]) {
            linkHash[records[i]] = {}
          }
          var j = i + 1
          for (j; j < records.length; j++) {
            if (linkHash[records[i]][records[j]] === undefined) {
              linkHash[records[i]][records[j]] = 1
            } else {
              linkHash[records[i]][records[j]]++
            }
          }
        }
      }
      for (var student in linkHash) {
        for (var connection in linkHash[student]) {
          let link = {
            'source': student,
            'target': connection,
            'value': linkHash[student][connection]
          }
          structure.links.push(link)
        }
      }
      return structure
    }
  },
  filters: {

  },
  updated: function () {
    this.clearNetworkDiagram()
    this.makeNetworkDiagram()
  },
  methods: {
    makeNetworkDiagram: function () {
      var svg = d3.select('#network')
      var width = +svg.attr('width')
      var height = +svg.attr('height')

      var color = d3.scaleOrdinal(d3.schemeCategory20)

      var simulation = d3.forceSimulation()
        .force('link', d3.forceLink().id(function (d) { return d.id }))
        .force('charge', d3.forceManyBody())
        .force('center', d3.forceCenter(width / 2, height / 2))

      var link = svg.append('g')
        .attr('class', 'links')
        .selectAll('line')
        .data(this.networkStructure.links)
        .enter().append('line')
        .attr('stroke-width', function (d) { return Math.sqrt(d.value) })

      var node = svg.append('g')
        .attr('class', 'nodes')
        .selectAll('circle')
        .data(this.networkStructure.nodes)
        .enter().append('circle')
        .attr('r', 5)
        .attr('fill', function (d) { return color(d.group) })
        .on('click', clicked)
        .call(d3.drag()
          .on('start', dragstarted)
          .on('drag', dragged)
          .on('end', dragended))

      node.append('title')
        .text(function (d) { return d.id })

      simulation
        .nodes(this.networkStructure.nodes)
        .on('tick', ticked)

      simulation.force('link')
        .links(this.networkStructure.links)

      function ticked () {
        link
          .attr('x1', function (d) { return d.source.x })
          .attr('y1', function (d) { return d.source.y })
          .attr('x2', function (d) { return d.target.x })
          .attr('y2', function (d) { return d.target.y })

        node
          .attr('cx', function (d) { return d.x })
          .attr('cy', function (d) { return d.y })
      }
      function clicked (d) {
        console.log(d)
      }
      function dragstarted (d) {
        if (!d3.event.active) simulation.alphaTarget(0.3).restart()
        d.fx = d.x
        d.fy = d.y
      }

      function dragged (d) {
        d.fx = d3.event.x
        d.fy = d3.event.y
      }

      function dragended (d) {
        if (!d3.event.active) simulation.alphaTarget(0)
        d.fx = null
        d.fy = null
      }
    },
    clearNetworkDiagram: function () {
      d3.selectAll('svg#network > g').remove()
    }
  },
  mounted: function () {
    this.clearNetworkDiagram()
    this.makeNetworkDiagram()
  }
}
</script>

<!-- Add 'scoped' attribute to limit CSS to this component only -->
<style>

.links line {
  stroke: #999;
  stroke-opacity: 0.6;
}

.nodes circle {
  stroke: #fff;
  stroke-width: 1.5px;
}
</style>
