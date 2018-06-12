<template>
<div class='container-fluid'>
  <div class='row mt-3'>
    <div class='col-lg-12'>
    <h1>{{ msg }}</h1>
    <h2>{{subtitle}}</h2>

        <div class='card-deck mt-3'>
          <div class='card'>
            <div class='card-body'>
              <h4 class='card-title'>{{eventList.length}} Total Events Attended</h4>
              <div id='line1' style='vertical-align: middle;display: inline-block; width: 100%; height: 75px;'></div>
            </div>
          </div>
          <div class='card'>
            <div class='card-body'>
              <h4 class='card-title'>{{totalHours}} Total Hours Logged</h4>
              <div id='line2' style='vertical-align: middle;display: inline-block; width: 100%; height: 75px;'></div>
            </div>
          </div>
          <div class='card'>
            <div class='card-body'>
              <h4 class='card-title'>{{records.length}} Total Reflections Submitted</h4>
              <div id='line3' style='vertical-align: middle;display: inline-block; width: 100%; height: 75px;'></div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-lg-6">
      <h3>Innovation by the Numbers</h3>
      <p>{{networkStructure.nodes.length}} students have made {{networkStructure.links.length}} connections across disciplines like business, engineering, art, sciences, and the humanities.
        Click on a node to see more details about that student.
      </p>
      <svg id='network' width='500' height='300'></svg>
    </div>
    <div class="col-lg-6">
      <div class="card" v-if="selectedStudentData">
        <div class="card-body">
          <p><img src="http://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png" class="img-fluid avatar-img"></p>
          <p>Name: <router-link :to="{path:'/students/' + selectedStudentData.name}">{{selectedStudentData.name}}</router-link></p>
          <p>Major: {{selectedStudentData.major}}</p>
          <p>Cohort: {{selectedStudentData.cohort}}</p>
          <p>Event Attended: {{selectedStudentData.reflectionCount}}</p>
          <p>Total Hours: {{selectedStudentData.totalHours}}</p>
          <div class="progress">
              <div class="progress-bar" role="progressbar" :style="{width: ((selectedStudentData.totalHours / 65) * 100) + '%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{Math.round(((selectedStudentData.totalHours / 65) * 100))}}%</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-lg-12">
      <h3>Student Satisfaction with the Innovate Experience</h3>
        <div id="innovateSatisfaction"></div>
    </div>
  </div>
</div>
</template>

<script>
import 'amcharts3/amcharts/amcharts'
import 'amcharts3/amcharts/serial'
import 'amcharts3/amcharts/themes/light'
import 'bootstrap/dist/css/bootstrap.min.css'
import * as d3 from 'd3'

export default {
  name: 'Index',
  data () {
    return {
      msg: 'Innovate LLP Analytics',
      subtitle: 'VCU Innovate LLP equips innovative entrepreneurs with a human-centered design foundation to launch new ventures or products.',
      selectedStudent: ''
    }
  },
  computed: {
    selectedStudentData: function () {
      let selectedStudentArr = this.records.filter(record => {
        return record.userEmail === this.selectedStudent
      })

      let selectedStudentData = ''
      if (selectedStudentArr.length >= 1) {
        selectedStudentData = {}
        selectedStudentData.name = selectedStudentArr[0].userEmail
        selectedStudentData.cohort = selectedStudentArr[0].userCohort
        selectedStudentData.major = selectedStudentArr[0].userMajor
        selectedStudentData.reflectionCount = selectedStudentArr.length
        selectedStudentData.totalHours = selectedStudentArr.reduce(function (total, value) {
          return parseInt(total) + parseInt(value.eventHours)
        }, 0)
      }

      return selectedStudentData
    },
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
    reflectionsByMonth: function () {
      const results = []
      let months = this.records.map(record => {
        return record.postDate.split(' ')[0].split('-')[1]
      })

      months.forEach(month => {
        let found = false
        results.forEach(result => {
          if (result.month === month) {
            result.count++
            found = true
          }
        })
        if (!found) {
          let newMonth = {
            month: month,
            count: 1
          }
          results.push(newMonth)
        }
      })
      return results
    },
    eventsByMonth: function () {
      let months = this.records.map(record => {
        let date = record.postDate.split(' ')[0].split('-')[1]
        let eventId = record.eventID
        let newEvent = {month: date, eventID: eventId}
        return newEvent
      })

      let results = []

      months.forEach(month => {
        let found = false
        results.forEach(result => {
          if (result.month === month.month) {
            result.events.push(month.eventID)
            found = true
          }
        })
        if (!found) {
          let newResult = {month: month.month, events: []}
          newResult.events.push(month.eventID)
          results.push(newResult)
        }
      })

      let unique = function (xs) {
        return xs.filter(function (x, i) {
          return xs.indexOf(x) === i
        })
      }

      results.forEach(result => {
        result.events = unique(result.events)
      })

      results = results.map(result => {
        return {month: result.month, count: result.events.length}
      })

      return results
    },
    hoursLoggedByMonth: function () {
      const results = []
      let months = this.records.map(record => {
        let date = record.postDate.split(' ')[0].split('-')[1]
        let hours = record.eventHours
        let newEvent = {month: date, hours: hours}
        return newEvent
      })

      months.forEach(month => {
        let found = false
        results.forEach(result => {
          if (result.month === month.month) {
            result.count = result.count + parseInt(month.hours)
            found = true
          }
        })
        if (!found) {
          let newMonth = {
            month: month.month,
            count: parseInt(month.hours)
          }
          results.push(newMonth)
        }
      })
      return results
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
    },
    innnovateSatisfaction: function () {
      const results = []
      let months = this.records.map(record => {
        return record.postDate.split(' ')[0].split('-')[1]
      })

      function onlyUnique (value, index, self) {
        return self.indexOf(value) === index
      }

      let uniqueMonths = months.filter(onlyUnique)

      uniqueMonths.forEach(month => {
        let monthData = {
          month: month,
          scores: []
        }
        this.records.forEach(record => {
          if (record.postDate.split(' ')[0].split('-')[1] === monthData.month) {
            monthData.scores.push(record.question5)
          }
        })
        results.push(monthData)
      })

      let averagedResults = results.map(result => {
        let average = ((result.scores.reduce((count, value) => parseInt(count) + parseInt(value), 0)) / result.scores.length).toFixed(2)

        let averagedResult = {
          month: result.month,
          average: average
        }
        return averagedResult
      })

      let sortedResults = averagedResults.sort((a, b) => {
        return parseInt(a.month) - parseInt(b.month)
      })
      return sortedResults
    }
  },
  filters: {

  },
  updated: function () {
    console.log(this.networkStructure)
    this.clearNetworkDiagram()
    this.makeNetworkDiagram()
    this.makeSerialChart()

    this.makeSparklineChart('line1', this.eventsByMonth, 'month', 'count')
    this.makeSparklineChart('line2', this.hoursLoggedByMonth, 'month', 'count')
    this.makeSparklineChart('line3', this.reflectionsByMonth, 'month', 'count')
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
        .on('click', updateStudentData)
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
      const vm = this
      function updateStudentData (d) {
        vm.selectedStudent = d.id
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
    },
    makeSparklineChart: function (id, dataProvider, categoryField, valueField) {
      window.AmCharts.makeChart(id, {
        'type': 'serial',
        'dataProvider': dataProvider,
        'categoryField': categoryField,
        'autoMargins': false,
        'marginLeft': 0,
        'marginRight': 0,
        'marginTop': 0,
        'marginBottom': 0,
        'graphs': [ {
          'valueField': valueField,
          'lineColor': '#a9ec49',
          'showBalloon': false
        } ],
        'valueAxes': [ {
          'gridAlpha': 0,
          'axisAlpha': 0
        } ],
        'categoryAxis': {
          'gridAlpha': 0,
          'axisAlpha': 0
        }
      })
    },
    makeSerialChart: function () {
      let chart = window.AmCharts.makeChart('innovateSatisfaction', {
        'path': 'davinci-events/davinci-analytics/dist/static/amcharts/',
        'type': 'serial',
        'theme': 'light',
        'marginRight': 40,
        'marginLeft': 40,
        'autoMarginOffset': 20,
        'dataDateFormat': 'MM',
        // 'titles': [{
        //   'text': 'Reflection Submissions Over Time',
        //   'size': 15
        // }],
        'valueAxes': [{
          'id': 'v1',
          'axisAlpha': 0,
          'position': 'left',
          'ignoreAxisWidth': true
        }],
        'balloon': {
          'borderThickness': 1,
          'shadowAlpha': 0
        },
        'graphs': [{
          'id': 'g1',
          'balloon': {
            'drop': true,
            'adjustBorderColor': false,
            'color': '#ffffff'
          },
          'bullet': 'round',
          'bulletBorderAlpha': 1,
          'bulletColor': '#FFFFFF',
          'bulletSize': 5,
          'hideBulletsCount': 50,
          'lineThickness': 2,
          'title': 'red line',
          'useLineColorForBulletBorder': true,
          'valueField': 'average',
          'balloonText': '<span style="font-size:18px;">[[value]]</span>'
        }],
        'chartScrollbar': {
          'graph': 'g1',
          'oppositeAxis': false,
          'offset': 30,
          'scrollbarHeight': 80,
          'backgroundAlpha': 0,
          'selectedBackgroundAlpha': 0.1,
          'selectedBackgroundColor': '#888888',
          'graphFillAlpha': 0,
          'graphLineAlpha': 0.5,
          'selectedGraphFillAlpha': 0,
          'selectedGraphLineAlpha': 1,
          'autoGridCount': true,
          'color': '#AAAAAA'
        },
        'chartCursor': {
          'pan': true,
          'valueLineEnabled': true,
          'valueLineBalloonEnabled': true,
          'cursorAlpha': 1,
          'cursorColor': '#258cbb',
          'limitToGraph': 'g1',
          'valueLineAlpha': 0.2,
          'valueZoomable': true
        },
        'categoryField': 'month',
        'categoryAxis': {
          'parseDates': true,
          'dashLength': 1,
          'minorGridEnabled': true
        },
        'export': {
          'enabled': true
        },
        'dataProvider': this.innnovateSatisfaction
      })

      chart.addListener('rendered', zoomChart)

      zoomChart()

      function zoomChart () {
        chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1)
      }
    }
  },
  mounted: function () {
    this.clearNetworkDiagram()
    this.makeNetworkDiagram()
    this.makeSerialChart()
    this.makeSparklineChart('line1', this.eventsByMonth, 'month', 'count')
    this.makeSparklineChart('line2', this.hoursLoggedByMonth, 'month', 'count')
    this.makeSparklineChart('line3', this.reflectionsByMonth, 'month', 'count')
  }
}
</script>

<!-- Add 'scoped' attribute to limit CSS to this component only -->
<style>
#innovateSatisfaction {
  height: 500px;
}

.links line {
  stroke: #999;
  stroke-opacity: 0.6;
}

.card-body .avatar-img {
  max-height: 50px;
}

.nodes circle {
  stroke: #fff;
  stroke-width: 1.5px;
}
</style>
