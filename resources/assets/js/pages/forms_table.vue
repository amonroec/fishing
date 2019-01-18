<template>
    <div id="ordersTable" style="padding: 0px 15px;">
    	<div class="card bg-info-card" style="overflow:scroll;">
    		<div class="card-body">
    			<h4 class="card-title">Orders</h4>

    			<table class="table" id="orderTable">
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
                    <button class="btn btn-danger" v-if="value.status !== 'canceled' && value.status === 'open'" @click="rejectFormPopup(value)">Cancel/Reject</button>
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

      <div id="showPdf" v-if="showPdf">
        <div class="background" @click="showPdf = false"></div>
        <div id="mdaWrapper">
          <a style="float:left;margin-left:auto;margin-right:auto;" class="btn btn-info" @click="showPdfFunction()">Print</a>
            <mda-pdf :cancel="true" style="float:left;" :form="selectedCancel"></mda-pdf>
          </div>
      </div>
  </div>
</template>
<script>
import axios from 'axios'
import swal from 'sweetalert2'
import MdaPdf from './mda_pdf'
import html2canvas from 'html2canvas'
import jsPDF from 'jspdf'
var methods = {}

methods.getForms = function () {
	axios.post('/api/getForms').then(response => {
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

methods.showPdfFunction = function () {
    // var that = this
    // setTimeout(function () {
    //     html2canvas(document.querySelector("#showPdf")).then(canvas => {  
    //         var dataURL = canvas.toDataURL();
    //         var pdf = new jsPDF();
    //         pdf.addImage(dataURL, 'PNG', 0, 0); //addImage(image, format, x-coordinate, y-coordinate, width, height)
    //         pdf.save("PDF");
    //       });
    // }, 1500)

    html2canvas(document.querySelector("#mdaPdf")).then(canvas => {  
      var dataURL = canvas.toDataURL("image/jpeg", 1.0);
      // $('#creditImage').val(dataURL)
      // window.open(dataURL)
      var pdf = new jsPDF();
        pdf.addImage(dataURL, 'jpeg', 0, 0); //addImage(image, format, x-coordinate, y-coordinate, width, height)
        // pdf.save("PDF");
        pdf = pdf.output('datauristring')
      var request = new XMLHttpRequest()
      var formData = new FormData()
      console.log(pdf)
      var that = this

      formData.append('image', pdf)
      formData.append('reject', true)
      formData.append('id', this.selectedCancel.id)
        // var comments = new FormData()
        // console.log(comments)
        formData.append('reject_reason', this.selectedCancel.reject_reason)
    formData.append('agent', this.selectedCancel.agent)
        request.open('post', '/api/submitForReview')
    request.send(formData)

    request.addEventListener("load", function(data) {
            console.log(data)
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
  });

    // console.log('innnn')
    // html2canvas(document.querySelector("#mdaPdf")).then(canvas => {
    //     console.log('in download')
    //     document.body.appendChild(canvas)
    //     var a = document.createElement('a');
    //     // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
    //     a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
    //     a.download = 'test.jpg';
    //     a.click();
    //     document.body.removeChild(canvas);
    // });
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
          // $('#myModal').modal('show')
          that.showPdf = true
        } else if (e.dismiss === 'cancel') {
          
        }
    })
}

export default {
    name: "FormsTable",
    middleware: 'auth',
    data: function () {
    	return {
    		data: null,
        cancel_reason: '',
        selectedCancel: '',
        showPdf: false
    	}
    },
    mounted: function() {
    	this.getForms()
    },
    components: {
      MdaPdf
    },
    methods: methods,
    destroyed: function() {

    }
}
</script>
<style scoped lang="scss">
#ordersTable {
	#orderTable {
		tbody {
			tr {
				&:hover {
					background-color: #e0e0e0 !important;
					cursor: pointer;
				}
			}
		}
	}


  #showPdf {
      position: fixed;
      width:100%;
      height:100%;
      padding-top:50px;
      padding-bottom: 50px;
      top:0;
      left:0;
      right:0;
      bottom:0;
      overflow:scroll;
      z-index:50;

      .background {
        position:fixed;
        top:0;left:0;right:0;bottom:0;
        background-color: rgba(0,0,0,.3);
        z-index: 51;
      }

      #mdaWrapper {
        position: absolute;
        background-color:#fff;
        width:8.5in;
        height:1500px;
        // top:50px;
        left:calc((100% - 8.5in) / 2);
        right:calc((100% - 8.5in) / 2);
        z-index:52;
      }
  }

}
</style>
