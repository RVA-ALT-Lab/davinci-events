<template>
  <div class='container-fluid'>
    <div class="row">
       <div class="col-lg-12">
       <h1>{{ msg }}</h1>
      <table class="table table-striped table-responsive">
        <thead class="thead-inverse">
          <tr>
            <th>Event Title</th>
            <th>Event ID</th>
            <th>Total Hours</th>
            <th>Total Reflections</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="event in eventsHash" :key="event.eventID">
            <th scope="row">
              <router-link :to="{path:'/events/' + event.eventID}">{{event.eventTitle}}</router-link>
            </th>
            <td>{{event.eventID}}</td>
            <td>{{event.eventHours}}</td>
            <td>{{event.reflections}}</td>
          </tr>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</template>

<script>
import 'amcharts3/amcharts/amcharts'
import 'amcharts3/amcharts/xy'
import 'amcharts3/amcharts/themes/light'

export default {
  name: 'Events',
  data () {
    return {
      msg: 'Innovate LLP Events'
    }
  },
  computed: {
    eventsHash: function () {
      let eventHash = {}
      this.$parent.records.forEach(record => {
        if (eventHash[record.eventID]) {
          eventHash[record.eventID]['reflections'] = eventHash[record.eventID]['reflections'] + 1
        } else {
          eventHash[record.eventID] = {
            eventID: record.eventID,
            eventTitle: record.eventTitle,
            eventHours: record.eventHours,
            reflections: 1
          }
        }
      })
      return eventHash
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

.grid-container {
  display: grid;
  grid-template-columns: 1fr 2fr;
}

.three-col-layout {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
}

#chartdiv {
  height: 500px;
}
</style>
