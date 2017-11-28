<template>
  <div class='container-fluid'>
    <div class="row">
       <div class="col-lg-12">
       <h1>{{ $route.params.id }}</h1>
       <div class="card mt-3" v-for="event in eventsList" :key="event.reflectionID">
         <div class="card-body">
          <h2>Submitted by {{event.userEmail}} on {{event.postDate}}</h2>
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
    }
  },
  created: function () {
  },
  updated: function () {

  },
  mounted: function () {
  },
  methods: {
    createChart: function () {
      let chart = window.AmCharts.makeChart('chartdiv', {
        'type': 'xy',
        'theme': 'light',
        'valueAxes': [{
          'axisAlpha': 0,
          'position': 'bottom'
        }, {
          'minMaxMultiplier': 1.2,
          'axisAlpha': 0,
          'position': 'left'
        }],
        'balloon': {
          'fixedPosition': true
        },
        'startDuration': 1.5,
        'graphs': [{
          'bullet': 'round',
          'bulletBorderAlpha': 0.2,
          'bulletAlpha': 0.8,
          'lineAlpha': 0,
          'fillAlphas': 0,
          'valueField': 'Exclusive_Distance',
          'balloonText': '<span style="font-size:18px;">State: [[State]]</br>In-State Students: [[x]]</br>Out-of-State Students: [[y]]</br>Total Distance Students: [[value]]</br></span>',
          'xField': 'InState_Students',
          'yField': 'OutOfState_Students',
          'maxBulletSize': 100
        }],
        'export': {
          'enabled': true
        },
        'dataProvider': this.filteredList
      })
      chart.addListener('clickGraphItem', this.selectState)
    },
    createLineChart: function () {
      window.AmCharts.makeChart('linechart', {
        'type': 'serial',
        'theme': 'light',
        'maginRight': 40,
        'marginLeft': 40,
        'autoMarginOffset': 20,
        'dataDateFormat': 'YYYY',
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
          'useLineColorForBulletBorder': true,
          'valueField': 'Exclusive_Distance'
        },
        {
          'id': 'g2',
          'balloon': {
            'drop': true,
            'adjustBorderColor': false,
            'color': '#ffffff'
          },
          'bullet': 'round',
          'bulletBorderAlpha': 1,
          'bulletColor': '#FFFFFF',
          'bulletSize': 5,
          'useLineColorForBulletBorder': true,
          'valueField': 'InState_Students'
        },
        {
          'id': 'g3',
          'balloon': {
            'drop': true,
            'adjustBorderColor': false,
            'color': '#ffffff'
          },
          'bullet': 'round',
          'bulletBorderAlpha': 1,
          'bulletColor': '#FFFFFF',
          'bulletSize': 5,
          'useLineColorForBulletBorder': true,
          'valueField': 'OutOfState_Students'
        },
        {
          'id': 'g4',
          'balloon': {
            'drop': true,
            'adjustBorderColor': false,
            'color': '#ffffff'
          },
          'bullet': 'round',
          'bulletBorderAlpha': 1,
          'bulletColor': '#FFFFFF',
          'bulletSize': 5,
          'useLineColorForBulletBorder': true,
          'valueField': 'Some_Distance'
        }
        ],
        'categoryField': 'Year',
        'categoryAxis': {
          'parseDates': true,
          'dashLength': 1,
          'minorGridEnabled': true
        },
        'export': {
          'enabled': true
        },
        'dataProvider': this.annualFilteredStateData
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

#chartdiv {
  height: 500px;
}
</style>
