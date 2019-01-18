<template>
    <div id="ordersTable" style="padding: 0px 15px;">
    	<div class="card bg-info-card">
    		<div class="card-body">
    			<h4 class="card-title">Orders</h4>

    			<table class="table">
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
                            <th>Actions</th>
    					</tr>
    				</thead>
    				<tbody>
    					<tr v-for="value in data">
    						<td @click="goToOrder(value.id)">{{value.id}}</td>
    						<td @click="goToOrder(value.id)">{{value.user_name}}</td>
    						<td @click="goToOrder(value.id)">{{value.user_email}}</td>
                            <td>{{value.city}}</td>
    						<td @click="goToOrder(value.id)">{{value.property_address}}</td>
    						<td @click="goToOrder(value.id)">${{value.pricing}}</td>
    						<td @click="goToOrder(value.id)">{{value.status}}</td>
    						<td @click="goToOrder(value.id)">{{value.created_at}}</td>
                <td>
                    <button class="btn btn-danger" v-if="value.status !== 'canceled'" @click="rejectFormPopup(value)">Cancel/Reject</button>
                </td>
    					</tr>
    				</tbody>
    			</table>
    		</div>
    	</div>

      <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title float-left">Reason For Canceling</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <textarea class="form-control" v-model="cancel_reason"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" @click="rejectForm()">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" @click="cancelReject()">Cancel</button>
              </div>
            </div>

          </div>
      </div>
  </div>
</template>
<script>
import axios from 'axios'
import swal from 'sweetalert2'
var methods = {}

methods.getForms = function () {
  const postData = {
    statusType: 'submitted_for_review'
  }
	axios.post('/api/getForms', postData).then(response => {
		if (response.status === 200) {
			console.log(response)
			this.data = response.data
		}
	})
}

methods.goToOrder = function (id) {
	this.$router.push('/form/' + id)
}

methods.rejectForm = function () {
  const postData = {
    data: this.selectedCancel,
    cancel_reason: this.cancel_reason
  }
  axios.post('/api/submitRejection', postData).then(response => {
    if (response.status === 200) {
      console.log(response)
      this.selectedCancel.status = 'canceled'
      this.selectedCancel = ''
      this.cancel_reason = ''
    }
  })
}

methods.cancelReject = function () {
  this.selectedCancel = ''
  this.cancel_reason = ''
}

methods.rejectFormPopup = function (value) {
  var that = this
    swal({
        title: 'Are you sure?',
        text: "Are you sure you want to cancel this form?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#66cc99',
        cancelButtonColor: '#ff6666',
        confirmButtonText: 'Yes, cancel it.',
        cancelButtonText: 'Nevermind.',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-default'
    }).then(function(e) {
        if (e.value) {
          that.selectedCancel = value
          // const postData = {
          //     data: value,
          //     user_id: that.$store.state.auth.user.id
          // }
          // console.log(postData)
          // axios.post('/api/cancelForm', postData).then(response => {
          //     console.log(response)
          //     if (response) {
                  
          //     }
          // })
          $('#myModal').modal('show')
        } else if (e.dismiss === 'cancel') {
          
        }
    })
}

export default {
    name: "FormsTable",
    data: function () {
    	return {
    		data: null,
        cancel_reason: '',
        selectedCancel: ''
    	}
    },
    mounted: function() {
    	this.getForms()
    },
    methods: methods,
    destroyed: function() {

    }
}
</script>
<style scoped lang="scss">
#ordersTable {
	table {
		tbody {
			tr {
				&:hover {
					background-color: #e0e0e0 !important;
					cursor: pointer;
				}
			}
		}
	}
}
</style>
