<template>
    <div id="myOrders">
    	<div class="card bg-info-card">
      <div class="card-body">
        <h4 class="card-title">Orders</h4>
        <table v-if="!noOrders && data" class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>User Name</th>
              <th>User Email</th>
              <th>Forms</th>
              <th>Price</th>
              <th>Status</th>
              <th>Payment</th>
              <th>Date Submitted</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(value, index) in data" @click="showOrdersPopup(value)">
              <td>{{value.id}}</td>
              <td>{{value.user_name}}</td>
              <td>{{value.user_email}}</td>
              <td>{{calculateCompleted(value.form_orders)}} / {{value.forms.length}}</td>
              <td>${{value.price}}</td>
              <td :class="value.status">{{value.status}}</td>
              <td :class="value.payment_status">{{value.payment_status}}</td>
              <td>{{value.created_at}}</td>
            </tr>
          </tbody>
        </table>

        <div v-else style="width:100%;text-align:center;font-size:50px;">
        	<i style="margin-top:150px;" class="fas fa-circle-notch fa-spin"></i><br />
        </div>
      </div>
    </div>


    <div id="ordersModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="width: 1200px !important;margin-left:auto;margin-right:auto;">
          <div class="modal-header">
            <h4 class="modal-title float-left">Forms</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body" style="width:100%;">
            <table class="table" style="width:100%;position:relative;" v-if="selectedOrders">
              <thead>
                <tr>
                  <th>Form ID</th>
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>City</th>
                  <th>Address</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Date Submitted</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="value in selectedOrders" @click="selectedOrderPopup(value)">
                  <td>{{value.id}}</td>
                  <td>{{value.user_name}}</td>
                  <td>{{value.user_email}}</td>
                  <td>{{value.city}}</td>
                  <td>{{value.property_address}}</td>
                  <td>${{value.pricing}}</td>
                  <td>{{value.status.split("_").join(" ")}}</td>
                  <td>{{value.created_at}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancelPopup()">Cancel</button>
          </div>
        </div>
      </div>
    </div>


    <div id="showPdf" v-if="selectedOrder && showPdf">
        <div class="background" @click="showPdf = false"></div>
    	<div id="mdaWrapper">
          <!-- <mda-pdf :form="selectedOrder"></mda-pdf> -->
          <iframe style="width:100%;height:1000px;" v-if="selectedOrder.form_pdf_url" :src="selectedOrder.form_pdf_url" ></iframe>
          <h3 v-else>This order has no pdf with it (not been submitted for approval).</h3>
      	</div>
    </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import MdaPdf from './mda_pdf'
import axios from 'axios'
var methods = {}

methods.getData = function () {
	const postData = {
		user_id: this.user.id
	}
	axios.post('/api/getMyOrders', postData).then(response => {
		if (response.status === 200) {
			console.log(response)
			if (response.data !== 'no-orders') {
				this.data = response.data
			} else {
				this.noOrders = true
			}
		}
	})
}

methods.calculateCompleted = function(forms) {
  var calc = 0
  forms.forEach(function(value) {
    if (value.status !== 'open') {
      calc++
    }
  })
  return calc
}

methods.checkStatuses = function (orders) {
	var calc = 0
	orders.forEach(function (value) {
		if (value.status !== 'open') {
			calc++
		}
	})
	if (calc === orders.length) {
		return true
	} else {
		return false
	}
}

methods.cancelPopup = function () {
	this.clickedOrder = null
	this.selectedOrders = null
}
methods.selectedOrderPopup = function (value) {
  // $('#ordersModal').modal('hide')
  this.showPdf = true
  this.selectedOrder = value
  console.log(this.selectedOrder)
  $('#orderModal').modal('show')
}

methods.showOrdersPopup = function(value) {
	this.clickedOrder = value
  this.selectedOrders = value.form_orders
  $('#ordersModal').modal('show')
}

export default {
    name: "MyOrders",
    middleware: 'auth',
    data: function () {
    	return {
    		noOrders: false,
    		data: null,
    		selectedOrders: null,
	      selectedOrder: null,
	      showPdf: false,
	      loading: false,
	      clickedOrder: null
    	}
    },
    computed: mapGetters({
	    user: 'auth/user'
	  }),
    mounted: function() {
    	this.getData()
    },
    methods: methods,
    destroyed: function() {

    }
}
</script>
<style lang="scss" scoped>
#myOrders {
	.modal-dialog {
		position: absolute;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    width: 100%;
	    height: 100%;
	    max-width: 100% !important;
	}

  table {
    tbody {
      tr {
        &:hover {
          background-color: #e0e0e0 !important;
          cursor: pointer;
        }

        td {
          &.open {
            color: green;
            text-transform: capitalize;
          }
          &.approved {
            color: green;
            text-transform: capitalize;
          }

          &.pending {
            color: orange;
            text-transform: capitalize;
          }

          &.complete {
            color: black;
            text-transform: capitalize;
          }

          &.canceled {
            color: red;
            text-transform: capitalize;
          }
        }
      }
    }
  }

  #showPdf {
        position: fixed;
        width:100%;
        height:100%;
        padding-bottom: 50px;
        top:0;
        left:0;
        right:0;
        bottom:0;
        overflow:scroll;
        z-index:1051;

        .background {
        	position:fixed;
        	top:0;left:0;right:0;bottom:0;
        	background-color: rgba(0,0,0,.3);
        	z-index: 1052;
        }

        #mdaWrapper {
        	position: absolute;
        	background-color:#e0e0e0;
        	padding-top:50px;
	        width:1200px;
	        height:1500px;
	        overflow-y: scroll;
	        // top:50px;
	        left:calc((100% - 1000px) / 2);
	        right:calc((100% - 1000px) / 2);
	        z-index:1053;

	        img {
	        	margin-left:calc((100% - 8.5in) / 2);
	        }
        }
    }
}
</style>
