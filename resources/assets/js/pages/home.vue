<template>
  <!-- <card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
  </card> -->
  <div class="col-12 float-left">
  	<div class="card bg-info-card" style="overflow:scroll;">
      <div class="card-body">
      	<div v-if="!loading">
	        <h4 class="card-title">Scoreboard</h4>
					  <div class="col-sm-12 col-md-12 col-lg-6 float-left" style="border:2px solid grey;background:rgb(125, 209, 148);">
					  	<h3 style="width:100%;float:left;text-align:center;">Team Austin - {{computeTotal('team_austin')}}</h3>
			        <table class="table">
			          <thead>
			            <tr>
			              <th>User</th>
			              <th>Species</th>
			              <th>Points</th>
			              <th>Weapon</th>
			              <th>Date</th>
			            </tr>
			          </thead>
			          <tbody>
			          	<tr v-for="value in team_austin">
			          		<td>{{value.user}}</td>
			          		<td>{{value.animal_type}}</td>
			          		<td>{{value.points}}</td>
			          		<td>{{value.weapon}}</td>
			          		<td>{{value.created_at}}</td>
			          	</tr>
			          </tbody>
			        </table>
			      </div>

					  <div class="col-sm-12 col-md-12 col-lg-6 float-left" style="border:2px solid grey;background:rgb(224, 107, 125);">
					  	<h3 style="width:100%;float:left;text-align:center;">Team Nick - {{computeTotal('team_nick')}}</h3>
			        <table class="table">
			          <thead>
			            <tr>
			              <th>User</th>
			              <th>Species</th>
			              <th>Points</th>
			              <th>Weapon</th>
			              <th>Date</th>
			            </tr>
			          </thead>
			          <tbody>
			          	<tr v-for="value in team_nick">
			          		<td>{{value.user}}</td>
			          		<td>{{value.animal_type}}</td>
			          		<td>{{value.points}}</td>
			          		<td>{{value.weapon}}</td>
			          		<td>{{value.created_at}}</td>
			          	</tr>
			          </tbody>
			        </table>
			      </div>
			    </div>
			    <div v-else style="width:100%;text-align:center;font-size:50px;">
	        	<i style="margin-top:50px;" class="fas fa-circle-notch fa-spin"></i><br />
	        </div>
	    </div>
	  </div>
	</div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
var methods = {}

methods.getData = function () {
	axios.post('/api/getScores').then(response => {
		if (response.status === 200 || response.status === 201) {
			console.log(response)
			this.team_nick = response.data.nick
			this.team_austin = response.data.austin
			this.loading = false
		}
	})
}

methods.computeTotal = function (val) {
	var total = 0
	if (this[val]) {
		this[val].forEach(function (value) {
			total += parseFloat(value.points)
		})
		return total.toFixed(2)
	}
}

export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: function () {
  	return {
  		loading: false,
  		team_nick: null,
  		team_austin: null
  	}
  },
  components: {

  },
  mounted: function () {
  	this.getData()
  },
  methods: methods
}
</script>
<style lang="scss" scoped>

</style>
