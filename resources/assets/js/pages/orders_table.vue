<template>
  <div id="ordersTable" style="padding: 0px 15px;">
    <div class="card bg-info-card" style="overflow:scroll;">
      <div class="card-body">
        <h4 class="card-title">Orders</h4>
        <table v-if="!loading" class="table orders_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>User Name</th>
              <th>User Email</th>
              <th>Forms</th>
              <th>Price</th>
              <th>Status</th>
              <th>Payment</th>
              <th style="width:250px !important;">Date Submitted</th>
            </tr>
          </thead>
          <!-- <tbody>
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
          </tbody> -->
          <tbody v-for="(value, index) in data">
          	<tr class="parent">
          		<td>{{value.id}}</td>
              <td>{{value.user_name}}</td>
              <td>{{value.user_email}}</td>
              <td>{{calculateCompleted(value.form_orders)}} / {{value.forms.length}}</td>
              <td>${{value.price}}</td>
              <td :class="value.status">{{value.status}}</td>
              <td :class="value.payment_status">{{value.payment_status}}</td>
              <td>{{value.created_at}}</td>
          	</tr>
          	<tr class="cchild">
          		<!-- <td>{{form.id}}</td>
              <td>{{form.user_name}}</td>
              <td>{{form.user_email}}</td>
              <td>{{form.city}}</td>
              <td>{{form.property_address}}</td>
              <td>${{form.pricing}}</td>
              <td>{{form.status.split("_").join(" ")}}</td>
              <td>{{form.created_at}}</td> -->
              <td colspan="8">
              	<div class="col-12 float-left" style="border-bottom:1px solid black;padding: 2px;">
              		<div class="col-2 float-left text-center">From ID</div>
              		<div class="col-3 float-left text-center">City</div>
              		<div class="col-3 float-left text-center">Addr.</div>
              		<div class="col-1 float-left text-center">Price</div>
              		<div class="col-3 float-left text-center">Status</div>
              	</div>
              	<div class="col-12 float-left childRow" style="padding:2px;" v-for="(form, i) in value.form_orders" @click="selectedOrderPopup(form)">
              		<div class="col-2 float-left text-center">{{form.id}}</div>
              		<div class="col-3 float-left text-center">{{form.city}}</div>
              		<div class="col-3 float-left text-center">{{form.property_address}}</div>
              		<div class="col-1 float-left text-center">{{form.pricing}}</div>
              		<div class="col-3 float-left text-center">{{form.status.split("_").join(" ")}}</div>
              	</div>
              </td>
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
                  <th>ID</th>
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
          	<div v-if="selectedOrders">
	            <button type="button" class="btn btn-success" v-if="checkStatuses(selectedOrders)" @click="submitToCustomer()" data-dismiss="modal">Check Off</button>
	            <label v-else>All forms in this order have not been submitted for review or declined yet.</label>
	        </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancelPopup()">Cancel</button>
          </div>
        </div>
      </div>
    </div>


    <div id="showPdf" v-if="selectedOrder && showPdf">
        <div class="background" @click="showPdf = false"></div>
    	<div id="mdaWrapper">
          <!-- <mda-pdf :form="selectedOrder"></mda-pdf> -->
          <iframe v-if="selectedOrder.form_pdf_url" :src="selectedOrder.form_pdf_url" ></iframe>
          <div v-else>This order has no pdf with it (not been submitted for approval).</div>
      	</div>
    </div>

  </div>
</template>
<script>
import axios from 'axios'
import MdaPdf from './mda_pdf'
import swal from 'sweetalert2'
var methods = {}

methods.getOrders = function() {
	this.loading = true
  axios.post('/api/getOrders').then(response => {
    if (response.status === 200) {
      console.log(response)
      this.data = response.data
      this.loading = false
      this.$emit('data-set')
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

methods.submitToCustomer = function () {
	const postData = {
		order: this.clickedOrder
	}
	console.log(postData)
	axios.post('/api/submitToCustomer', postData).then(response => {
		if (response.status === 200) {
			console.log(response)
			swal('Success!', 'You have successfully sent Order# ' + this.clickedOrder.id + ' to ' + this.clickedOrder.email + '.', 'success')
			this.clickedOrder.status = response.data.status
		}
	})
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

methods.goToOrder = function(id) {
  this.$router.push('/order/' + id)
}

export default {
  name: "OrdersTable",
  middleware: 'auth',
  data: function() {
    return {
      data: null,
      selectedOrders: null,
      selectedOrder: null,
      showPdf: false,
      loading: false,
      clickedOrder: null
    }
  },
  components: {
    MdaPdf
  },
  mounted: function() {
    this.getOrders()
    this.$on('data-set', function () {
    	setTimeout(function () {
    		$('.orders_table').on('click', 'tr.parent', function(){
				  $(this).closest('tbody').toggleClass('openrow');
				});
    	}, 1000)
    })
  },
  methods: methods,
  destroyed: function() {

  }
}

</script>
<style scoped lang="scss">
#ordersTable {

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

          &.bill_later {
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
        	// position: absolute;
        	// // background-color:#e0e0e0;
        	// padding-top:50px;
	        // width:1200px;
	        // height:1500px;
	        // overflow-y: scroll;
	        // // top:50px;
	        // left:calc((100% - 1000px) / 2);
	        // right:calc((100% - 1000px) / 2);
	        // z-index:1053;

	        iframe {
	        	position:fixed;
	        	top:0;
	        	width:1200px;
	        	height:100%;
	        	left: calc((100% - 1200px) / 2);
	        	right: calc((100% - 1200px) / 2);
	        	bottom: 0;
	        	z-index:1053;
	        }

	        div {
	        	position:fixed;
	        	top:100px;
	        	background-color: #fff;
	        	border-radius: 10px;
	        	box-shadow: 1px 1px 4px 4px #000;
	        	text-align:center;
	        	font-size:30px;
	        	width:800px;
	        	line-height: 100px;
	        	height:100px;
	        	left: calc((100% - 800px) / 2);
	        	right: calc((100% - 800px) / 2);
	        	z-index:1053;
	        }

	        // img {
	        // 	margin-left:calc((100% - 8.5in) / 2);
	        // }
        }
    }

    .childRow {
    	height:35px !important;
    	line-height: 35px;

    	&:hover {
    		background-color: #ccc;
    	}
    }

    .parent ~ .cchild {
		  display: none;
		}
		.openrow .parent ~ .cchild {
		  display: table-row;
		  // transition: height 2s;
		}
		.parent {
		  cursor: pointer;
		}
		tbody {
		  color: #212121;
		}
		.openrow {
		  background-color: #e6e6e6;
		  // transition: height 2s;
		}

		.openrow .cchild {
		  // background-color: #999;
		  color: #000;
		}
		// .parent > *:last-child {
		//   width: 30px;
		// }
		.parent i {
		  // transform: rotate(0deg);
		  // transition: transform .3s cubic-bezier(.4,0,.2,1);
		  // margin: -.5rem;
		  // padding: .5rem;
		 
		}
		// .openrow .parent i {
		//   transform: rotate(180deg)
		// }
}

</style>
