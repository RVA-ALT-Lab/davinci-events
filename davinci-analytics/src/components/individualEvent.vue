<template>
  <div class='container-fluid'>
    <div class="row">
       <div class="col-lg-12">
       <h1>{{ $route.params.id }}</h1>
        <div class="row">
         <div class="col-lg-6">
           <div id="individualBarChart"></div>
         </div>
         <div class="col-lg-6">
           <div id="individualPieChart"></div>
         </div>
       </div>
       <div class="card mt-3" v-for="event in eventsList" :key="event.reflectionID">
         <div class="card-body">
          <h2>Submitted by {{event.userEmail}} on {{event.postDate.split(' ')[0]}}</h2>
          <div v-html="event.reflectionContent">

          </div>
         </div>
       </div>
      </div>
    </div>
  </div>
</template>

<script>
import 'amcharts3/amcharts/amcharts'
import 'amcharts3/amcharts/xy'
import 'amcharts3/amcharts/themes/light'

export default {
  name: 'individualEvent',
  data () {
    return {
      msg: 'Innovate LLP Events'
    }
  },
  computed: {
    records: function () {
      return this.$parent.records
    },
    eventsList: function () {
      return this.records.filter(record => {
        return record.eventID === this.$route.params.id
      })
    },
    questionSummary: function () {
      let questionObject = {
        total: 0,
        question1: 0,
        question2: 0,
        question3: {
          yes: 0,
          no: 0
        },
        question4: 0,
        question5: 0
      }
      this.eventsList.forEach(item => {
        questionObject.total++
        questionObject.question1 = questionObject.question1 + parseInt(item.question1)
        questionObject.question2 = questionObject.question2 + parseInt(item.question2)
        if (item.question3.toLowerCase() === 'yes') {
          questionObject.question3.yes++
        } else {
          questionObject.question3.no++
        }
        questionObject.question4 = questionObject.question4 + parseInt(item.question4)
        questionObject.question5 = questionObject.question5 + parseInt(item.question5)
      })
      questionObject.question1 = (questionObject.question1 / questionObject.total).toFixed(1)
      questionObject.question2 = (questionObject.question2 / questionObject.total).toFixed(1)
      questionObject.question4 = (questionObject.question4 / questionObject.total).toFixed(1)
      questionObject.question5 = (questionObject.question5 / questionObject.total).toFixed(1)

      return questionObject
    }
  },
  created: function () {
  },
  updated: function () {
    this.makeBarChart()
    this.makePieChart()
  },
  mounted: function () {
    this.makeBarChart()
    this.makePieChart()
  },
  methods: {
    makeBarChart: function () {
      window.AmCharts.makeChart('individualBarChart', {
        'type': 'serial',
        'theme': 'light',
        'rotate': false,
        'titles': [{
          'text': 'Survey Responses',
          'size': 15
        }],
        'dataProvider': [
          {
            'question': 'Question 1',
            'average': this.questionSummary.question1,
            'label': 'I\'m confident I can use some things I\'ve learned today.'
          },
          {
            'question': 'Question 2',
            'average': this.questionSummary.question2,
            'label': 'I was well engaged during the event.'
          },
          {
            'question': 'Question 4',
            'average': this.questionSummary.question4,
            'label': 'The event was beneficial to my studies.'
          },
          {
            'question': 'Question 5',
            'average': this.questionSummary.question5,
            'label': 'My current assessment of my overall Innovate experience thus far.'
          }
        ],
        'valueAxes': [ {
          'position': 'top',
          'axisAlpha': 0,
          'gridColor': '#FFFFFF',
          'gridAlpha': 0.2,
          'dashLength': 0,
          'min': 0,
          'minimum': 0
        }],
        'gridAboveGraphs': true,
        'startDuration': 1,
        'graphs': [{
          'balloonText': '[[label]]</br>[[category]]: <b>[[value]]</b>',
          'fillAlphas': 0.8,
          'lineAlpha': 0.2,
          'type': 'column',
          'valueField': 'average'
        }],
        'chartCursor': {
          'categoryBalloonEnabled': false,
          'cursorAlpha': 0,
          'zoomable': false
        },
        'categoryField': 'question',
        'categoryAxis': {
          'position': 'left',
          'gridPosition': 'start',
          'gridAlpha': 0,
          'tickPosition': 'start',
          'tickLength': 20
        },
        'export': {
          'enabled': true
        }
      })
    },
    makePieChart: function () {
      window.AmCharts.makeChart('individualPieChart', {
        'type': 'pie',
        'theme': 'light',
        'titles': [{
          'text': 'This experience taught me something new.',
          'size': 10
        }],
        'dataProvider': [ {
          'answer': 'yes',
          'value': this.questionSummary.question3.yes
        },
        {
          'answer': 'no',
          'value': this.questionSummary.question3.no
        }
        ],
        'valueField': 'value',
        'titleField': 'answer',
        'balloon': {
          'fixedPosition': true
        },
        'export': {
          'enabled': true
        }
      })
    }
  }
}
</script>

<!-- Add 'scoped' attribute to limit CSS to this component only -->
<style scoped>

.three-col-layout {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
}

#individualBarChart,
#individualPieChart {
  height: 500px;
}
</style>
