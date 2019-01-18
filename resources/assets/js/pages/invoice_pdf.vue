<template>
    <div id="invoicePdf">
    	<div id="invoiceOrdersWrapper">
	    	<div class="col-12 float-left">
	    		<div class="col-6 float-left">
	    			<img style="height:70px;" src="./../../images/mpo_white_600_200.png" />
	    		</div>
	    		<div class="col-6 float-left">
	    			<div style="width:100%;float:left;text-align:right;color:#42af55;font-size:20px;">INVOICE DETAILS</div>
	    			<table id="invoiceTopTable" style="width:100%;float:left;" border="1">
	    				<thead>
	    					<tr>
	    						<th style="width:50%;text-align:center;background-color:#42af55;">Invoice Number</th>
	    						<th style="width:50%;text-align:center;background-color:#42af55;">Date</th>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<tr>
	    						<td style="width:50%;text-align:center;">{{invoice_number}}</td>
	    						<td style="width:50%;text-align:center;">{{configureTodayDate()}}</td>
	    					</tr>
	    				</tbody>
	    				<thead>
	    					<tr>
	    						<th style="width:50%;text-align:center;background-color:#42af55;">Customer</th>
	    						<th style="width:50%;text-align:center;background-color:#42af55;">Billing Cycle</th>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<tr>
	    						<td style="width:50%;text-align:center;">{{company}}</td>
	    						<td style="width:50%;text-align:center;">August 2018</td>
	    					</tr>
	    				</tbody>
	    			</table>
	    		</div>
	    	</div>
	    	<div class="col-12 float-left">
	    		<table id="ordersTab" class="table table-striped">
	    			<thead>
	    				<tr>
	    					<th>Order #</th>
	    					<th>Order Date</th>
	    					<th>User</th>
	    					<th>Property</th>
	    					<th>Item</th>
	    					<th>Price</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				<tr v-for="value in orders">
	    					<td>{{value.id}}</td>
	    					<td>{{formatDate(value.created_at)}}</td>
	    					<td>{{value.user_email}}</td>
	    					<td>{{value.full_name}} - {{value.address}}</td>
	    					<td>Market Data Analysis</td>
	    					<td>{{value.price}}</td>
	    				</tr>
	    			</tbody>
	    		</table>
	    		<div class="col-12 float-left">
	    			<div class="col-2 float-right text-right">
	    				<b>Total</b> {{configureTotal()}}
	    			</div>
	    			<div class="col-2 float-right text-right">
	    				<b>{{orders.length}} Items</b>
	    			</div>
	    		</div>
	    	</div>
	    </div>
    </div>
</template>
<script>
var methods = {}
var moment = require('moment');

methods.formatDate = function (date) {
	var d = moment(date)
	return d.format('M/DD/YYYY')
}

methods.configureTotal = function () {
	var calc = 0
	this.orders.forEach(function (value) {
		calc += parseInt(value.price)
	})
	return calc
}

methods.configureTodayDate = function () {
	var d = moment().format('MM/DD/YYYY')
	return d
}

export default {
    name: "InvoicePDF",
    data: function () {
    	return {

    	}
    },
    props: ['orders', 'company', 'invoice_number'],
    mounted: function() {
    	console.log(this.orders)
    },
    methods: methods,
    destroyed: function() {

    }
}
</script>
<style lang="scss" scoped>
#invoicePdf {
	width: 100%;
	height:auto;
	float:left;
	background-color:#fff;

	#invoiceOrdersWrapper {
		width: 8.5in;
		height:11in;
		float:left;
		background-color: #fff;
	}

	#invoiceTopTable {
		font-size:13px;
		border-color: #e0e0e0;
		height:60px;

		// table {

			thead {
				tr {
					th {
						color: #fff;
					}
				}
			}
		// }
	}

	#ordersTab {

			thead {
				tr {
					th {
						text-align:center;
					}
				}
			}
			tbody {
				tr {

					td {
						padding: 0px !important;
						font-size:12px;
						text-align:center;
					}
				}
			}
	}
}
</style>
