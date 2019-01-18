<template>
    <div id="cart" class="col-12">
    	<div v-if="data" class="card bg-info-card">
    		<div class="card-body">
    			<h4 class="card-title">Cart</h4>
	    		<div v-for="(value,index) in data" class="card" style="width: 100%;">
					  <div class="card-body" @click="">
					    <h5 class="card-title">Order {{index + 1}}</h5>
					    <p class="card-text">{{value.form_type.replace(/_/g,' ').replace(/'/g,'')}} - {{value.property_owner}} - {{value.zoning}}
					    	<a data-toggle="collapse" :href="'#order' + index" role="button" aria-expanded="false" :aria-controls="'order' + index">Click for more details</a>
					    	<a class="float-right" @click="removeItem(value, index)"><i class="fa fa-trash"></i>Remove</a>
					    </p>
					    
					    <div class="collapse multi-collapse" :id="'order' + index">
					      <div class="card card-body">
					      	<market-analysis-form :data="value" :type="value.form_type"></market-analysis-form>
					      </div>
					    </div>
					  </div>
					</div>
					<div class="card-footer text-center">
						<button v-if="data.length" class="btn btn-success" @click="goToCheckout()">Proceed To Checkout</button>
						<div class="text-center" v-else>
							You have no items in your cart. <br />
							<a style="color: #007bff;cursor: pointer;text-decoration: underline;" @click="goToForms()">Go To Products</a>
						</div>
					</div>
				</div>
	    </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import MarketAnalysisForm from './../market_analysis_form'
import axios from 'axios'
import swal from 'sweetalert2'
var methods = {}

methods.getCart = function () {
	axios.get('/api/getCart/' + this.user.id).then(response => {
		if (response.status === 200) {
			this.data = response.data
		}
	})
}

methods.goToForms = function () {
	this.$router.push('/market_analysis_form')
}

methods.goToCheckout = function () {
	this.$router.push('/checkout')
}

methods.orderCart = function () {
	var that = this
	swal({
      title: 'Are you sure?',
      text: "Are you sure you want to order every item that's in your cart?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#66cc99',
      cancelButtonColor: '#ff6666',
      confirmButtonText: 'Yes, order it.',
      cancelButtonText: 'Cancel.',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-default'
  }).then(function(e) {
      if (e.value) {
      	if (that.user) {
	        const postData = {
	        	data: that.data,
	        	user_id: that.$store.state.auth.user.id
	        }
	      } else {
	      	const postData = {
	      		data: that.data,
	      		user_id: 'guest'
	      	}
	      }
        console.log(postData)
        axios.post('/api/orderCart', postData).then(response => {
        	console.log(response)
        	if (response) {
        		
        	}
        })
      } else if (e.dismiss === 'cancel') {
        
      }
  })
}

methods.removeItem = function (value, index) {
	var that = this
	swal({
      title: 'Are you sure?',
      text: "Are you sure you want to remove this item from your cart?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#66cc99',
      cancelButtonColor: '#ff6666',
      confirmButtonText: 'Yes, remove it.',
      cancelButtonText: 'No, keep it.',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger'
  }).then(function(e) {
      if (e.value) {
      	if (this.user) {
	        const postData = {
	        	value: value
	        }
	        axios.post('/api/removeCartItem', postData).then(response => {
	        	console.log(response)
	        	if (response) {
	        		that.data.splice(index, 1)
	        	}
	        })
	      } else {
	      	window.localStorage.removeItem('cart')
	      }
      } else if (e.dismiss === 'cancel') {
        
      }
  })
}

export default {
    name: "Cart",
    data: function () {
    	return {
    		data: null
    	}
    },
    components: {
    	MarketAnalysisForm
    },
    mounted: function() {
    	console.log(this.user)
    	if (this.user) {
    		this.getCart()
    	} else {
    		if (window.localStorage.getItem('cart')) {
    			this.data = JSON.parse(window.localStorage.getItem('cart'))
    		} else {
    			this.data = null
    		}
    	}
    },
    computed: mapGetters({
	    user: 'auth/user'
	  }),
    methods: methods,
    destroyed: function() {

    }
}
</script>
