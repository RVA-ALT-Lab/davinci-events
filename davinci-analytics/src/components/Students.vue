<template>
  <div class='container-fluid'>
    <div class="row">
      <div class="col-lg-12">
    <h1>{{ msg }}</h1>
    <div class="row">
      <div class="col-lg-3">

        <h3>Data Filters</h3>
          <div class="form-group">
            <label for="filter">Text Filter</label>
            <input type="text" name="filter" class="form-control" v-model="localFilter">
          </div>
          <div class="form-group">
            <label for="cohortFilter">Cohort Filter</label>
            <select name="cohortFilter" class="form-control" v-model="cohortFilter">
              <option value="All">All</option>
              <option value="2016 – 2018">2016 - 2018</option>
              <option value="2017 – 2019">2017 - 2019</option>
            </select>
          </div>
          <div class="form-group">
            <label for="majorFilter">Major Filter</label>
            <select name="majorFilter" class="form-control" v-model="majorFilter">
              <option value="All">All</option>
              <option value="Engineering">Engineering</option>
              <option value="Business">Business</option>
              <option value="Arts">Arts</option>
              <option value="Humanities and Sciences">Humanities and Sciences</option>
              <option value="Other">Other</option>
            </select>
          </div>
        </div>
        <div class="col-lg-9">
          <div id="chartDiv"></div>
        </div>
    </div>
    <table class="table table-striped table-responsive">
      <thead class="thead-inverse">
        <tr>
          <th>Student</th>
          <th>Total Events</th>
          <th>Total Hours</th>
          <th>Major</th>
          <th>Cohort</th>
          <th>Progress</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="student in studentsList" :key="student.userEmail">
          <th scope="row">
          <img src="http://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png" class="img-fluid avatar-img">
            <router-link :to="{path:'/students/' + student.userEmail}">{{student.userEmail}}</router-link>
          </th>
          <td class="assignment">{{student.records.length}}</td>
          <td class="assignment">{{student.totalHours}}</td>
          <td class="assignment">{{student.major}}</td>
          <td class="assignment">{{student.cohort}}</td>
          <td class="assignment">
            <div class="progress">
              <div class="progress-bar" role="progressbar" :style="{width: ((student.totalHours / 65) * 100) + '%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
      </div>
    </div>
  </div>
</template>

<script>
import 'amcharts3/amcharts/amcharts'
import 'amcharts3/amcharts/serial'
import 'amcharts3/amcharts/themes/light'

export default {
  name: 'Students',
  data () {
    return {
      msg: 'Innovate LLP Students',
      localFilter: '',
      cohortFilter: 'All',
      majorFilter: 'All'
    }
  },
  computed: {
    records: function () {
      console.log(this.$parent.records)
      return this.$parent.records
    },
    localList: function () {
      let localList = this.records
      if (this.cohortFilter !== 'All') {
        localList = localList.filter(record => {
          return this.cohortFilter === record.userCohort
        })
      }

      if (this.majorFilter !== 'All') {
        localList = localList.filter(record => {
          return this.majorFilter === record.userMajor
        })
      }
      let localFilter = this.localFilter
      if (localFilter === '') {
        return localList
      } else {
        return localList.filter(function (record) {
          for (let value in record) {
            if (record.hasOwnProperty(value) && (record[value] !== null && record[value] !== undefined)) {
              if (record[value].toLowerCase().includes(localFilter.toLowerCase())) {
                return true
              }
            }
          }
          return false
        })
      }
    },
    studentsList: function () {
      let studentHash = {}
      this.localList.forEach(record => {
        if (studentHash[record['userEmail']]) {
          studentHash[record['userEmail']]['records'].push(record)
        } else {
          studentHash[record['userEmail']] = {
            userEmail: record['userEmail'],
            major: record['userMajor'],
            cohort: record['userCohort'],
            totalHours: 0,
            records: []
          }
          studentHash[record['userEmail']].records.push(record)
        }
      })

      for (let student in studentHash) {
        studentHash[student].totalHours = studentHash[student].records.reduce((accumulator, currentValue) => {
          return accumulator + parseInt(currentValue.eventHours)
        }, 0)
      }
      return studentHash
    },
    serialList: function () {
      let serialList = []
      let records = this.localList
      records.forEach(record => {
        var itemToTest = {
          postDate: record.postDate.split(' ')[0],
          value: 1
        }
        var found = false
        if (serialList.length === 0) {
          serialList.push(itemToTest)
        } else {
          serialList.forEach(item => {
            if (item.postDate === itemToTest.postDate) {
              item.value++
              found = true
            }
          })
          if (!found) {
            serialList.push(itemToTest)
          }
        }
      })
      serialList.sort(function (a, b) {
        return new Date(a.postDate) - new Date(b.postDate)
      })
      return serialList
    }
  },
  mounted: function () {
    this.makeSerialChart()
  },
  updated: function () {
    this.makeSerialChart()
  },
  methods: {
    makeSerialChart: function () {
      let chart = window.AmCharts.makeChart('chartDiv', {
        'path': 'https://rampages.us/davinci-events/wp-content/themes/davinci-events/davinci-analytics/dist/static/amcharts/',
        'type': 'serial',
        'theme': 'light',
        'marginRight': 40,
        'marginLeft': 40,
        'autoMarginOffset': 20,
        'dataDateFormat': 'YYYY-MM-DD',
        'titles': [{
          'text': 'Reflection Submissions Over Time',
          'size': 15
        }],
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
          'valueField': 'value',
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
        'categoryField': 'postDate',
        'categoryAxis': {
          'parseDates': true,
          'dashLength': 1,
          'minorGridEnabled': true
        },
        'export': {
          'enabled': true
        },
        'dataProvider': this.serialList
      })

      chart.addListener('rendered', zoomChart)

      zoomChart()

      function zoomChart () {
        chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1)
      }
    }
  }
}
</script>

<!-- Add 'scoped' attribute to limit CSS to this component only -->
<style scoped>
.avatar-img {
  max-height: 35px;
  border-radius: 50%;
}

thead th, td {
  text-align: center;
}

th {
  vertical-align: top;
}

#chartDiv {
  height: 500px;
}
</style>
