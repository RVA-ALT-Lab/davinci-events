<template>
  <div class='container-fluid'>
    <div class="row">
      <div class="col-lg-4">
        <h1>{{$route.params.id}}</h1>
        <p><img src="http://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png" class="img-fluid avatar-img"></p>
        <p>Major: {{student.major}}</p>
        <p>Cohort: {{student.cohort}}</p>
        <p>Event Attended: {{studentList.length}}</p>
        <p>Total Hours: {{student.totalHours}}</p>
        <div class="progress">
              <div class="progress-bar" role="progressbar" :style="{width: ((student.totalHours / 65) * 100) + '%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{Math.round(((student.totalHours / 65) * 100))}}%</div>
            </div>
      </div>
      <div class="col-lg-8">
         <div id="individualStudentChartDiv"></div>
      </div>
    </div>
    <div class="mt-3" v-for="reflection in studentList" :key="reflection.reflectionID">
      <div class="card">
        <div class="card-body">
          <h2 class="card-title">
            <router-link :to="{path:'/events/' + reflection.eventID}">{{reflection.eventTitle}}</router-link> on {{reflection.postDate.split(' ')[0]}}
          </h2>
          <div v-html="reflection.reflectionContent"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import 'amcharts3/amcharts/amcharts'
import 'amcharts3/amcharts/serial'
import 'amcharts3/amcharts/themes/light'

export default {

  name: 'individualStudent',
  data () {
    return {
      msg: 'Explore Schools'
    }
  },
  computed: {
    records: function () {
      return this.$parent.records
    },
    studentList: function () {
      return this.records.filter(record => {
        return record.userEmail === this.$route.params.id
      })
    },
    student: function () {
      let student = {}
      this.studentList.forEach(record => {
        if (record.userEmail === this.$route.params.id) {
          student.userEmail = record.userEmail
          student.major = record.userMajor
          student.cohort = record.userCohort
        }
      })
      student.totalHours = this.studentList.reduce((accumulator, currentValue) => {
        return accumulator + parseInt(currentValue.eventHours)
      }, 0)

      return student
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
      let chart = window.AmCharts.makeChart('individualStudentChartDiv', {
        'path': 'dist/static/amcharts/',
        'type': 'serial',
        'theme': 'light',
        'marginRight': 40,
        'marginLeft': 40,
        'autoMarginOffset': 20,
        'dataDateFormat': 'YYYY-MM-DD',
        'titles': [{
          'text': 'Reflection Hours Over Time',
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
          'valueField': 'eventHours',
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
        'dataProvider': this.studentList
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
  max-height: 100px;
  border-radius: 50%;
}

#individualStudentChartDiv {
  height: 300px;
}
</style>
