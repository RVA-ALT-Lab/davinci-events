<?php
/**
 * Template Name: Analytics
 *
 * Template to see all student data - only available to admin
 *
 * @package understrap
 */

get_header();

?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div id="app">
				<records-table :records="records"></records-table>
			</div>
		</div>

	</div>



</div>

<script type="text/x-template" id="records-table">
	<div>
		<h3>Responses Per Question</h3>

		<h3>Total Reflections Over Time</h3>
		<div id="chartDiv" style="height: 500px;">
		</div>
		<input type="text" name="filter" v-model="localFilter">
		<label for="eventFilter">Event Filter</label>
		<select name="eventFilter" v-model="eventFilter">
			<option value="All">All</option>
			<option v-for="event in eventsList">{{event}}</option>
		</select>
		<label for="cohortFilter">Cohort Filter</label>
		<select name="cohortFilter" v-model="cohortFilter">
			<option value="All">All</option>
			<option value="2016 – 2018">2016 - 2018</option>
			<option value="2017 – 2019">2017 - 2019</option>
		</select>

		<label for="majorFilter">Major Filter</label>
		<select name="majorFilter" v-model="majorFilter">
			<option value="All">All</option>
			<option value="Engineering">Engineering</option>
			<option value="Business">Business</option>
			<option value="Arts">Arts</option>
			<option value="Humanities and Sciences">Humanities and Sciences</option>
			<option value="Other">Other</option>
		</select>
		{{questionSummary.total}}
		<table class="table">
			<thead>
				<th>Reflection ID</th>
				<th>Event Title</th>
				<td>Post Date</td>
				<td>Event Hours</td>
				<td>User Cohort</td>
				<td>User Email</td>
				<td>User Major</td>
			</thead>
			<tr v-for="record in localList" :key="record.reflectionID">
				<td>{{record.reflectionID}}</td>
				<td>{{record.eventTitle}}</td>
				<td>{{record.postDate}}</td>
				<td>{{record.eventHours}}</td>
				<td>{{record.userCohort}}</td>
				<td>{{record.userEmail}}</td>
				<td>{{record.userMajor}}</td>
			</tr>
		</table>
	</div>
</script>

<script type="text/javascript">



	Vue.component('records-table',
	{
		template: '#records-table',
		props: ['records'],
		data: function(){
			return {
				localFilter: '',
				eventFilter: 'All',
				cohortFilter: 'All',
				majorFilter: 'All'
			}
		},
		computed: {

			eventsList: function(){
				let eventsList = this.records.map(function(record){
					return record.eventTitle;
				})

				function onlyUnique(value, index, self){
					return self.indexOf(value) === index;
				}
				eventsList = eventsList.filter(onlyUnique)
				return eventsList;
			},
			serialList: function(){
				let serialList = [];

				let records = this.records;
				records.forEach(record => {
					var itemToTest = {
							postDate: record.postDate.split(' ')[0],
							value: 1
						}
					var found = false;
					if (serialList.length === 0){
						serialList.push(itemToTest);
					} else {
						serialList.forEach(item => {
							if (item.postDate === itemToTest.postDate){
								item.value++;
								found = true;
							}
						})
						if (!found){
							serialList.push(itemToTest);
						}
					}
				})
				serialList.sort(function(a,b){
					return new Date(a.postDate) - new Date(b.postDate);
				})

				return serialList;
			},
			questionSummary: function(){
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
				this.localList.forEach(item =>{
					questionObject.total++;
					questionObject.question1 = questionObject.question1 + item.question1;
					questionObject.question2 = questionObject.question2 + item.question2;

					if (questionObject.question3.toString().toLowerCase() == 'yes'){
						questionObject.question3.yes++
					} else {
						questionObject.question3.no++
					}

					questionObject.question4 = questionObject.question1 + item.question4;
					questionObject.question5 = questionObject.question1 + item.question5;
				})

				questionObject.question1 = questionObject.question1/ questionObject.total;
				questionObject.question2 = questionObject.question2/ questionObject.total;
				questionObject.question3 = questionObject.question3/ questionObject.total;
				questionObject.question4 = questionObject.question4/ questionObject.total;
				questionObject.question5 = questionObject.question5/ questionObject.total;

				console.log(questionObject);
				return questionObject;
			},
			localList: function(){

				let localList = this.records;

				if (this.eventFilter !== 'All'){
					localList = localList.filter(record => {
						return this.eventFilter == record.eventTitle;
					})
				}

				if (this.cohortFilter !== 'All'){
					localList = localList.filter(record => {
						console.log(record.userCohort)
						return this.cohortFilter == record.userCohort;
					})
				}

				if (this.majorFilter !== 'All'){
					localList = localList.filter(record => {
						console.log(record.userMajor)
						return this.majorFilter == record.userMajor;
					})
				}


				let localFilter = this.localFilter;
				if (localFilter === ''){
					return localList;
				} else {
				 return	localList.filter(function(record){
				 	for(value in record){
				 		if (record.hasOwnProperty(value) && ( record[value] !== null && record[value] !== undefined ) ){
				 			console.log(typeof record[value])
							if (record[value].toLowerCase().includes( localFilter.toLowerCase() )){
								console.log('true')
								return true;
							}
				 		}
				 	}

				 	return false;
				 })
				}
			}
		},
		methods:{
			makeSerialChart: function(){
				var chart = AmCharts.makeChart("chartDiv", {
					"type": "serial",
					"theme": "light",
					"marginRight": 40,
					"marginLeft": 40,
					"autoMarginOffset": 20,
					"mouseWheelZoomEnabled":true,
					"dataDateFormat": "YYYY-MM-DD",
					"valueAxes": [{
						"id": "v1",
						"axisAlpha": 0,
						"position": "left",
						"ignoreAxisWidth":true
					}],
					"balloon": {
						"borderThickness": 1,
						"shadowAlpha": 0
					},
					"graphs": [{
						"id": "g1",
						"balloon":{
						"drop":true,
						"adjustBorderColor":false,
						"color":"#ffffff"
						},
						"bullet": "round",
						"bulletBorderAlpha": 1,
						"bulletColor": "#FFFFFF",
						"bulletSize": 5,
						"hideBulletsCount": 50,
						"lineThickness": 2,
						"title": "red line",
						"useLineColorForBulletBorder": true,
						"valueField": "value",
						"balloonText": "<span style='font-size:18px;'>[[value]]</span>"
					}],
					"chartScrollbar": {
						"graph": "g1",
						"oppositeAxis":false,
						"offset":30,
						"scrollbarHeight": 80,
						"backgroundAlpha": 0,
						"selectedBackgroundAlpha": 0.1,
						"selectedBackgroundColor": "#888888",
						"graphFillAlpha": 0,
						"graphLineAlpha": 0.5,
						"selectedGraphFillAlpha": 0,
						"selectedGraphLineAlpha": 1,
						"autoGridCount":true,
						"color":"#AAAAAA"
					},
					"chartCursor": {
						"pan": true,
						"valueLineEnabled": true,
						"valueLineBalloonEnabled": true,
						"cursorAlpha":1,
						"cursorColor":"#258cbb",
						"limitToGraph":"g1",
						"valueLineAlpha":0.2,
						"valueZoomable":true
					},
					"valueScrollbar":{
					"oppositeAxis":false,
					"offset":50,
					"scrollbarHeight":10
					},
					"categoryField": "postDate",
					"categoryAxis": {
						"parseDates": true,
						"dashLength": 1,
						"minorGridEnabled": true
					},
					"export": {
						"enabled": true
					},
					"dataProvider": this.serialList
				});

				chart.addListener("rendered", zoomChart);

				zoomChart();

				function zoomChart() {
					chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
				}
			}
		},
		updated: function(){
			this.makeSerialChart();
		}
	})

	new Vue({
		el: '#app',
		data: function(){
			return {
				records: [],
				inputFilter: ''
			};
		},
		methods: {
			getData: function(){
				this.$http.get('/davinci-events/wp-json/davinci/v1/data').then(response =>{
					this.records = response.body;
					console.log(this.records)
				}, response => {
					console.log(response);
				})
			}
		},
		mounted: function(){
			this.getData();
		},
		computed: {
		}
	})
</script>

<?php
get_footer();

?>