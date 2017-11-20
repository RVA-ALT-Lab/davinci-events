<template>
  <div class='hello'>
    <h1>{{ msg }}</h1>
    <h2>{{$route.params.id}}</h2>
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
  },
  created: function () {
  },
  update: function () {

  },
  methods: {
  }
}
</script>

 <!-- Add 'scoped' attribute to limit CSS to this component only -->
<style scoped>
</style>
