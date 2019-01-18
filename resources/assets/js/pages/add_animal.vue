<template>
  <div class="col-12 float-left addAnimal">
    <div class="card bg-info-card" style="overflow:scroll;">
      <div class="card-body">
        <h4 class="card-title">Add Animal</h4>
        <form @submit.prevent="submitForm()" method="POST">
	        <div class="col-12 float-left">
	        	<div class="col-12 float-left">
	        		<div class="col-4 float-left text-right label">Animal Type:</div>
	        		<div class="col-8 float-left text-left value">
	        			<select v-model="form.animal_type" class="form-control">
	        				<option value="">Select Animal</option>
	        				<option v-for="value in animalTypes" :value="value">{{value}}</option>
	        			</select>
	        		</div>
	        	</div>
	        	<div class="col-12 float-left">
	        		<div class="col-4 float-left text-right label">Size:</div>
	        		<div class="col-8 float-left text-left value">
	        			<input type="text" v-model="form.size" class="form-control" />
	        		</div>
	        	</div>
	        	<div class="col-12 float-left">
	        		<div class="col-4 float-left text-right label">Weapon:</div>
	        		<div class="col-8 float-left text-left value">
	        			<!-- <input type="text" v-model="form.weapon" class="form-control" /> -->
	        			<select v-if="configureWeaponShow()" v-model="form.weapon" class="form-control">
	        				<option value="">Select Weapon</option>
	        				<option v-for="value in weapons" :value="value">{{value}}</option>
	        			</select>
	        		</div>
	        	</div>
	        </div>

	        <div class="col-12 float-left">
	        	<input type="file" name="image" class="dropify" data-max-file-size="10M" data-allowed-file-extensions="pdf png jpg jpeg ai zip xls eps bmp" />
	        </div>
	        <div class="col-12 float-left text-center p-2">
	        	<button class="btn btn-success">Submit</button>
	        </div>
	      </form>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import dropify from "dropify"
import { mapGetters } from 'vuex'
import swal from 'sweetalert2'
var methods = {}

methods.configureWeaponShow = function () {
	if (this.form.animal_type.includes('Fish') || this.form.animal_type === '') {
		return false
	} else {
		return true
	}
}

methods.submitForm = function () {
	var form = document.querySelector('form')
  var that = this

    var request = new XMLHttpRequest()
    var formData = new FormData(form)
    // var comments = new FormData()
    // console.log(comments)
    console.log(this.form)
    // formData.append('form', JSON.stringify(this.form))
    formData.append('animal_type', this.form.animal_type)
    formData.append('size', this.form.size)
    formData.append('weapon', this.form.weapon)
    formData.append('user_id', this.user.id)
    formData.append('user', this.user.name)
    formData.append('team', this.user.team)
    
    request.open('post', '/api/addAnimal')
		request.send(formData)
		request.addEventListener("load", function(data) {
        console.log(data)
        if (data.currentTarget.status === 200 || data.currentTarget.status === 201) {
        	if (that.user.team === 'Nick') {
        		swal('Success!', 'Congrats fucking faggot. Your submission has been received and will be reviewed by a god.', 'success')
        	} else {
        		swal('Success!', 'OMG you are awesome and you will dominate those other faggots.', 'success')
        	}
        	that.form = {
        		animal_type: '',
		  			size: '',
		  			weapon: ''
        	}
        } else {
        	swal('Oops!', 'Something went wrong. Please contact your best friend to fix your dumbass mistake.', 'error')
        }
        // if (data.currentTarget.status === 200) {
        //     // that.$router.push('/')
        //     that.$router.push('/task/artpack/' + data.currentTarget.response)
        // } else {
        //     // that.$router.push('/500')
        //     Ladda.stopAll();
        //     var obj = {
        //         name: 'asiForm',
        //         form: that.form
        //     }
        //     that.$store.dispatch('formError', obj)
        // }
    })
}

export default {
  name: "AddAnimal",
  middleware: 'auth',
  data: function () {
  	return {
  		form: {
  			animal_type: '',
  			size: '',
  			weapon: ''
  		},
  		animalTypes: ['Whitetail-Doe', 'Whitetail-Buck', 'Fish-Bass', 'Fish-Trout', 'Fish-Crappie', 'Turkey'],
  		weapons: ['Gun', 'Bow']
  	}
  },
  mounted: function() {
  	console.log(this.user)
  	$(document).ready(function () {
  		$('.dropify').dropify();
  	})
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  methods: methods,
  destroyed: function() {

  }
}

</script>
<style lang="scss" scoped>
.addAnimal {
	.label {
		font-size:18px;
		padding: 10px;
	}
	.value {
		padding:10px;
	}
}
</style>
