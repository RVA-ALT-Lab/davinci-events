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
		<h3>Total Reflections Over Time</h3>
		<svg width="640" height="400"></svg>
		<div id="pieChartDiv" style="height: 400px;"></div>
		<div id="barChartDiv" style="height: 400px;"></div>
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
				<td>{{record.eventID}}</td>
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

				let records = this.localList;
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
					questionObject.question1 = questionObject.question1 + parseInt(item.question1);
					questionObject.question2 = questionObject.question2 + parseInt(item.question2);
					if (item.question3.toLowerCase() == 'yes'){
						questionObject.question3.yes++
					} else {
						questionObject.question3.no++
					}
					questionObject.question4 = questionObject.question4 + parseInt(item.question4);
					questionObject.question5 = questionObject.question5 + parseInt(item.question5);
				})
				questionObject.question1 = (questionObject.question1/ questionObject.total).toFixed(1);
				questionObject.question2 = (questionObject.question2/ questionObject.total).toFixed(1);
				questionObject.question4 = (questionObject.question4/ questionObject.total).toFixed(1);
				questionObject.question5 = (questionObject.question5/ questionObject.total).toFixed(1);

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
						return this.cohortFilter == record.userCohort;
					})
				}

				if (this.majorFilter !== 'All'){
					localList = localList.filter(record => {
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
							if (record[value].toLowerCase().includes( localFilter.toLowerCase() )){
								return true;
							}
				 		}
				 	}

				 	return false;
				 })
				}
			},
			networkStructure: function(){
				//This data structure will be built from this.records
				//since it caclulates the totality of the student interactions

				//Create our eventual final data structure
				let structure = {
					"nodes": [],
					"links": []
				}

				//Create a hash of user emails to use as id
				let nodeHash = {}
				this.records.forEach(record => {
					nodeHash[record.userEmail] =
					{
						id: record.userEmail,
						group: (!record.userMajor)? 'N/A' : record.userMajor
					}
				})
				//Loop through nodeHash and push node object into array
				for (var prop in nodeHash){
					structure.nodes.push(nodeHash[prop])
				}

				//Do something similar here to all of the events to calculate
				//links; Since we are analyzing coattendance at events, create
				//hashes for the individual event ID, then loop through them
				let eventHash = {}
				this.records.forEach(record => {
					if (eventHash[record.eventID]){
						eventHash[record.eventID].push(record);
					} else {
						eventHash[record.eventID] = [];
						eventHash[record.eventID].push(record);
					}
				})
				for (var event in eventHash){
					var records = eventHash[event];
					records.sort(function(a, b) {
						var nameA = a.userEmail.toUpperCase(); // ignore upper and lowercase
						var nameB = b.userEmail.toUpperCase(); // ignore upper and lowercase
						if (nameA < nameB) {
							return -1;
						}
						if (nameA > nameB) {
							return 1;
						}

						// names must be equal
						return 0;
						});

					let sortedArray = [];
					records.forEach( record => {
						sortedArray.push(record.userEmail)
					})

					uniqueArray = returnUnique(sortedArray);

					eventHash[event] = uniqueArray;
				}

				function returnUnique(arr){
					let seen = {};
					return arr.filter(item => {
						return seen.hasOwnProperty(item) ? false :(seen[item] = true)
					})
				}

				let linkHash = {

				}

				for (var event in eventHash){
					var records = eventHash[event];


					for (var i = 0; i < records.length; i++){
						if( !linkHash[records[i]] ){
							linkHash[records[i]] = {}
						}
						var j = i + 1;

						for (j; j < records.length; j++){
							if(linkHash[records[i]][records[j]] == undefined){
								linkHash[records[i]][records[j]] = 1;
							} else {
								linkHash[records[i]][records[j]]++
							}
						}
					}
				}

				for (var student in linkHash){

					for(var connection in linkHash[student]){
						let link = {
							"source": student,
							"target": connection,
							"value":linkHash[student][connection]
						}
						structure.links.push(link);
					}
				}
				console.log(structure);

				return structure;
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
			},
			makeNetworkDiagram: function(){
				var svg = d3.select("svg");
				var width = +svg.attr("width");
				var height = +svg.attr("height");

				var color = d3.scaleOrdinal(d3.schemeCategory20);

				var simulation = d3.forceSimulation()
					.force("link", d3.forceLink().id(function(d) { return d.id; }))
					.force("charge", d3.forceManyBody())
					.force("center", d3.forceCenter(width / 2, height / 2));


				var link = svg.append("g")
					.attr("class", "links")
					.selectAll("line")
					.data(this.networkStructure.links)
					.enter().append("line")
					.attr("stroke-width", function(d) { return Math.sqrt(d.value); });

				var node = svg.append("g")
					.attr("class", "nodes")
					.selectAll("circle")
					.data(this.networkStructure.nodes)
					.enter().append("circle")
					.attr("r", 5)
					.attr("fill", function(d) { return color(d.group); })
					.on("click", clicked)
					.call(d3.drag()
						.on("start", dragstarted)
						.on("drag", dragged)
						.on("end", dragended));

				node.append("title")
					.text(function(d) { return d.id; });

				simulation
					.nodes(this.networkStructure.nodes)
					.on("tick", ticked);

				simulation.force("link")
					.links(this.networkStructure.links);

				function ticked() {
					link
						.attr("x1", function(d) { return d.source.x; })
						.attr("y1", function(d) { return d.source.y; })
						.attr("x2", function(d) { return d.target.x; })
						.attr("y2", function(d) { return d.target.y; });

					node
						.attr("cx", function(d) { return d.x; })
						.attr("cy", function(d) { return d.y; });
				}
				function clicked(d){
					console.log(d);
				}
				function dragstarted(d) {
				if (!d3.event.active) simulation.alphaTarget(0.3).restart();
				d.fx = d.x;
				d.fy = d.y;
				}

				function dragged(d) {
				d.fx = d3.event.x;
				d.fy = d3.event.y;
				}

				function dragended(d) {
				if (!d3.event.active) simulation.alphaTarget(0);
				d.fx = null;
				d.fy = null;
				}
			},
			makeBarChart: function(){
				var chart = AmCharts.makeChart( "barChartDiv", {
				"type": "serial",
				"theme": "light",
				"dataProvider": [
					{
						"question": "Question 1",
						"average": this.questionSummary.question1
					},
					{
						"question": "Question 2",
						"average": this.questionSummary.question2
					},
					{
						"question": "Question 4",
						"average": this.questionSummary.question4
					},
					{
						"question": "Question 5",
						"average": this.questionSummary.question5
					}
				 ],
				"valueAxes": [ {
					"gridColor": "#FFFFFF",
					"gridAlpha": 0.2,
					"dashLength": 0
				} ],
				"gridAboveGraphs": true,
				"startDuration": 1,
				"graphs": [ {
					"balloonText": "[[category]]: <b>[[value]]</b>",
					"fillAlphas": 0.8,
					"lineAlpha": 0.2,
					"type": "column",
					"valueField": "average"
				} ],
				"chartCursor": {
					"categoryBalloonEnabled": false,
					"cursorAlpha": 0,
					"zoomable": false
				},
				"categoryField": "question",
				"categoryAxis": {
					"gridPosition": "start",
					"gridAlpha": 0,
					"tickPosition": "start",
					"tickLength": 20
				},
				"export": {
					"enabled": true
				}

				} );
			},
			makePieChart: function(){
				var chart = AmCharts.makeChart( "pieChartDiv", {
					"type": "pie",
					"theme": "light",
					"dataProvider": [ {
						"answer": "yes",
						"value": this.questionSummary.question3.yes
						},
						{
						"answer": "no",
						"value": this.questionSummary.question3.no
						}
					],
					"valueField": "value",
					"titleField": "answer",
					"balloon":{
					"fixedPosition":true
					},
					"export": {
						"enabled": true
					}
					} );
			}
		},
		updated: function(){
			this.makeSerialChart();
			this.makeNetworkDiagram();
			this.makeBarChart();
			this.makePieChart();
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