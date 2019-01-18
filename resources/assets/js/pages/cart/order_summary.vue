<template>
    <div id="orderSummary">
    	<div class="col-12 text-center float-left" v-if="data">
    		<h1 style="width:100%;">Order Confirmed!</h1>
    		<h2 style="width:100%;">Order #{{data.id}}</h2>
    	</div>
    	<div class="col-12 col-lg-6 text-center float-left">
        <div class="card bg-info-card">
          <div class="card-body" v-if="data">
            <h4 class="card-title">Billing Information</h4>
            <div class="card-body billing">
            	<div class="col-12 float-left">
            		<label class="labelHeader">Contact Information</label>
            		<span>{{data.user_email}}</span>
            	</div>
            	<div class="col-12 float-left">
            		<label class="labelHeader">Billing Address</label>
            		<span>{{data.user_name}}</span>
            		<span>{{data.address}}</span>
            		<span>{{data.city}}, {{data.state}} {{data.zip_code}}</span>
            	</div>
            	<div class="col-12 float-left" v-if="stripe">
            		<label class="labelHeader">Credit Card</label>
            		<span>{{stripe.source.brand}} - {{stripe.source.last4}}</span>
            	</div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-6 text-center float-left">
      	<div class="card bg-info-card">
          <div class="card-body">
            <h4 class="card-title">Your Order</h4>
            <div class="card-body">
            	<table class="table" v-if="data">
            		<thead>
            			<tr>
            				<th>#</th>
            				<th>ITEM</th>
            				<th>TOTAL</th>
            			</tr>
            		</thead>
            		<tbody>
            			<tr v-for="(value, index) in data.forms_array">
            				<td>{{index + 1}}</td>
            				<td>
            					<label v-show="value.form_type === 'market_analysis'">Market Data Analysis</label><br />
            					<label>{{value.property_owner}}</label> - 
            					<label>{{value.property_address}}</label>
            				</td>
            				<td style="line-height:100%;">
            					{{value.pricing}}
            				</td>
            			</tr>
            			<tr>
            				<td>{{data.forms_array.length}}</td>
            				<td> </td>
            				<td>{{data.price}}</td>
            			</tr>
            		</tbody>
            	</table>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
var methods = {}

methods.getOrder = function () {
	if (!this.user) {
		var route = '/api/getGuestOrderSummary'
	} else {
		var route = '/api/getOrderSummary'
	}
	const postData = {
		token: this.token
	}
	axios.post(route, postData).then(response => {
		if (response.status === 200 || response.status === 201) {
			console.log(response)
			this.data = response.data.res
			this.stripe = response.data.stripe
		}
	})
}

export default {
    name: "OrderSummary",
    data: function () {
    	return {
    		data: null,
    		stripe: null
    	}
    },
    props: ['token'],
    mounted: function() {
    	console.log(this.token)
    	this.getOrder()
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
#orderSummary {
	.billing {
		text-align:left;

		.labelHeader {
			width:100%;
			font-weight: 900;
			float:left;
		}

		span {
			width: 100%;
			float:left;
		}
	}
}
</style>
