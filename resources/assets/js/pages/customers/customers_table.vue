<template>
    <div id="customers_table" style="padding:0px 15px;">
    	<div class="card" title="Customers Table">
			  <div class="card-body">
		    	<div class="col-12">
		    		<table class="table">
		    			<thead>
		    				<tr>
		    					<th>ID</th>
		    					<th style="min-width:150px;">Name</th>
		    					<th style="min-width:150px;">Company</th>
		    					<th style="min-width:150px;">Email Domain</th>
		    					<th>Standard</th>
		    					<th>Rush</th>
		    					<th>DriveBy 1</th>
		    					<th>DriveBy 2</th>
		    					<th>DriveBy 3</th>
		    					<th>Comps Only</th>
		    					<th>Actions</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    				<tr v-if="customers" v-for="value in customers">
		    					<td>{{value.id}}</td>
		    					<td>
		    						<input type="text" disabled v-model="value.name" class="form-control" />
		    					</td>
		    					<td>
		    						<input type="text" disabled v-model="value.company" class="form-control" />
		    					</td>
		    					<td>
		    						<input type="text" disabled v-model="value.email_domain" class="form-control" />
		    					</td>
		    					<td>
		    						<input type="text" disabled v-model="value.pricing_standard" class="form-control" />
		    					</td>
		    					<td>
		    						<input type="text" disabled v-model="value.pricing_rush" class="form-control" />
		    					</td>
		    					<td>
		    						<input type="text" disabled v-model="value.pricing_drive_by_1" class="form-control" />
		    					</td>
		    					<td>
		    						<input type="text" disabled v-model="value.pricing_drive_by_2" class="form-control" />
		    					</td>
		    					<td>
		    						<input type="text" disabled v-model="value.pricing_drive_by_3" class="form-control" />
		    					</td>
		    					<td>
		    						<input type="text" disabled v-model="value.pricing_comps_only" class="form-control" />
		    					</td>
		    					<td>
		    						<button class="btn btn-default" data-toggle="modal" data-target="#editCustomer" @click="editCustomer = value">Edit</button>
		    					</td>
		    				</tr>
		    			</tbody>
		    		</table>
		    		<div class="col-12 text-center">
		    			<button class="btn btn-success" data-toggle="modal" data-target="#addCustomer">Add Customer</button>
		    		</div>
		    	</div>

		    	<!-- Modal for adding customer -->
		    	<div id="addCustomer" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title text-left">Add Customer</h4>
					      </div>
					      <div class="modal-body">
					        <div class="col-12">
			    					<div class="col-6 float-left">Name</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="addCustomer.name" />
			    					</div>

			    					<div class="col-6 float-left">Company Name</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="addCustomer.company" />
			    					</div>

			    					<div class="col-6 float-left">Email Domain (@mail.com)</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="addCustomer.email_domain" />
			    					</div>

			    					<div class="col-6 float-left">Standard</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="addCustomer.pricing_standard" />
			    					</div>

			    					<div class="col-6 float-left">Rush</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="addCustomer.pricing_rush" />
			    					</div>

			    					<div class="col-6 float-left">DriveBy 1</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="addCustomer.pricing_drive_by_1" />
			    					</div>

			    					<div class="col-6 float-left">DriveBy 2</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="addCustomer.pricing_drive_by_2" />
			    					</div>

			    					<div class="col-6 float-left">DriveBy 3</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="addCustomer.pricing_drive_by_3" />
			    					</div>

			    					<div class="col-6 float-left">Comps Only</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="addCustomer.pricing_comps_only" />
			    					</div>

					        </div>
					      </div>
					      <div class="modal-footer">
					      	<button type="button" class="btn btn-success" data-dismiss="modal" @click="addNewCustomer()">Submit</button>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>

					  </div>
					</div>

					<!-- Edit customer -->
					<div id="editCustomer" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title text-left">Edit Customer</h4>
					      </div>
					      <div class="modal-body">
					        <div class="col-12">
			    					<div class="col-6 float-left">Name</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="editCustomer.name" />
			    					</div>

			    					<div class="col-6 float-left">Company Name</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="editCustomer.company" />
			    					</div>

			    					<div class="col-6 float-left">Email Domain (@mail.com)</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="editCustomer.email_domain" />
			    					</div>

			    					<div class="col-6 float-left">Standard</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="editCustomer.pricing_standard" />
			    					</div>

			    					<div class="col-6 float-left">Rush</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="editCustomer.pricing_rush" />
			    					</div>

			    					<div class="col-6 float-left">DriveBy 1</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="editCustomer.pricing_drive_by_1" />
			    					</div>

			    					<div class="col-6 float-left">DriveBy 2</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="editCustomer.pricing_drive_by_2" />
			    					</div>

			    					<div class="col-6 float-left">DriveBy 3</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="editCustomer.pricing_drive_by_3" />
			    					</div>

			    					<div class="col-6 float-left">Comps Only</div>
			    					<div class="col-6 float-left">
			    						<input type="text" class="form-control" v-model="editCustomer.pricing_comps_only" />
			    					</div>

					        </div>
					      </div>
					      <div class="modal-footer">
					      	<button type="button" class="btn btn-success" data-dismiss="modal" @click="saveCustomer()">Save</button>
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>

					  </div>
					</div>
				</div>
			</div>

    </div>
</template>
<script>
import swal from 'sweetalert2'
import axios from 'axios'
var methods = {}

methods.getCustomers = function () {
	axios.get('/api/getCustomers').then(response => {
		console.log(response)
		if (response.status === 200) { 
			this.customers = response.data
		} else {
			swal('Error!', 'Something went wrong with pulling customers.', 'error')
		}
	})
}

methods.addNewCustomer = function () {
	const postData = {
		customer: this.addCustomer
	}
	axios.post('/api/addNewCustomer', postData).then(response => {
		if (response.status === 200) {
			console.log(response)
			$('#addCustomer').hide()
			swal('Success!', 'You have successfully created a customer.', 'success')
		} else {
			swal('Error!', 'Something went wrong with adding this customer.', 'error')
		}
	})
}

methods.saveCustomer = function () {
	const postData = {
		customer: this.editCustomer
	}
	axios.post('/api/saveCustomer', postData).then(response => {
		if (response.status === 200) {
			console.log(response)
			$('#editCustomer').hide()
			swal('Success!', 'You have successfully saved this customer.', 'success')
		} else {
			swal('Error!', 'Something went wrong with saving this customer.', 'error')
		}
	})
}

methods.clearCustomer = function (type) {
	this[type] = {
		name: '',
		company: '',
		email_domain: '',
		pricing_standard: '',
		pricing_rush: '',
		pricing_drive_by_1: '',
		pricing_drive_by_2: '',
		pricing_drive_by_3: '',
		pricing_comps_only: ''
	}
}

export default {
    name: "CustomersTable",
    data: function () {
    	return {
    		addCustomer: {
    			name: '',
    			company: '',
    			email_domain: '',
    			pricing_standard: '',
    			pricing_rush: '',
    			pricing_drive_by_1: '',
    			pricing_drive_by_2: '',
    			pricing_drive_by_3: '',
    			pricing_comps_only: ''
    		},
    		customers: null,
    		editCustomer: {
    			name: '',
    			company: '',
    			email_domain: '',
    			pricing_standard: '',
    			pricing_rush: '',
    			pricing_drive_by_1: '',
    			pricing_drive_by_2: '',
    			pricing_drive_by_3: '',
    			pricing_comps_only: ''
    		}
    	}
    },
    methods: methods,
    mounted: function() {
    	this.getCustomers()
    },
    destroyed: function() {

    }
}
</script>
