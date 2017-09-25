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

<script src="https://unpkg.com/vue"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4"></script>

<script type="text/x-template" id="records-table">
	<div>
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
		<p>{{eventFilter}}</p>
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
				this.$http.get('/wp-json/davinci/v1/data').then(response =>{
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