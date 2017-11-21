<template>
  <div class='container-fluid'>
    <div class="row">
      <div class="col-lg-12">
    <h1>{{ msg }}</h1>
    <table class="table table-striped table-responsive">
      <thead class="thead-inverse">
        <tr>
          <th>Student</th>
          <th>Total Hours</th>
          <th>Major</th>
          <th>Cohort</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">
          <img src="http://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png" class="img-fluid avatar-img">
            <a href="#">Jeff Everhart</a>
          </th>
          <td>jeverhart2@vcu.edu</td>
          <td class="assignment"><i class="fa fa-file-text"></i></td>
          <td class="assignment"><i class="fa fa-check"></i></td>
          <td class="assignment"><i class="fa fa-comment"></i></td>
        </tr>
        <tr>
          <th scope="row">
          <img src="http://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png" class="img-fluid avatar-img">
            <a href="#">Matt Roberts</a>
          </th>
          <td>robertsmd@vcu.edu</td>
          <td class="assignment"><i class="fa fa-file-text"></i></td>
          <td class="assignment"><i class="fa fa-check"></i></td>
          <td class="assignment"><i class="fa fa-comment"></i></td>
        </tr>
        <tr>
          <th scope="row">
            <img src="http://dsi-vd.github.io/patternlab-vd/images/fpo_avatar.png" class="img-fluid avatar-img">
            <a href="#">Tom Woodward</a>
          </th>
          <td>woodwardtw@vcu.edu</td>
          <td class="assignment"><i class="fa fa-file-text"></i></td>
          <td class="assignment"><i class="fa fa-check"></i></td>
          <td class="assignment"><i class="fa fa-comment"></i></td>
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
      msg: 'Innovate LLP Students'
    }
  },
  computed: {
    records: function () {
      return this.$parent.records
    },
    studentsList: function () {

    }
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
</style>
