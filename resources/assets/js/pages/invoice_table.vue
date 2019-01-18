<template>
  <div id="ordersTable" style="padding: 0px 15px;">
    <div class="card bg-info-card">
      <div class="col-12 float-left text-center">
        <button class="btn btn-info" @click="printInvoice = true">Print Invoice</button>
      </div>
      <div class="col-12 float-left">
        <div class="col-3 float-left text-center p-2">
          Start Date
        </div>
        <div class="col-3 float-left text-center p-2">
          End Date
        </div>
        <div class="col-4 float-left text-center p-2">
          Company
        </div>
        <div class="col-2 float-left text-center p-2">
        </div>
        <div class="col-3 float-left text-center p-2">
          <input type="date" class="form-control" v-model="startDate" />
        </div>
        <div class="col-3 float-left text-center p-2">
          <input type="date" class="form-control" v-model="endDate" />
        </div>
        <div v-if="companies" class="col-4 float-left text-center p-2">
          <select v-model="company" class="form-control">
            <option value="">Select Company</option>
            <option v-for="value in companies" :value="value.company">{{value.company}}</option>
          </select>
        </div>
        <div class="col-2 float-left text-center p-2">
          <button class="btn btn-info" @click="getData()">Submit</button>
        </div>
      </div>
      <div class="card-body">
        <table id="invoice_table" v-if="!loading && data" class="table">
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
            <tr v-for="(value, index) in data">
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
        <div v-else-if="loading" style="width:100%;text-align:center;font-size:50px;">
          <i style="margin-top:150px;" class="fas fa-circle-notch fa-spin"></i><br />
        </div>
      </div>
    </div>


    <div id="showPdf" v-if="printInvoice">
      <div class="background" @click="printInvoice = false"></div>
      <div id="mdaWrapper">
        <div class="col-12 text-center float-left">
          <a style="float:left;margin-left:auto;margin-right:auto;" @click="submitInvoice()" class="btn btn-info">Submit Invoice</a>
        </div>
        <invoice-pdf :orders="data" :company="company" :invoice_number="invoice_number"></invoice-pdf>
      </div>
    </div>

  </div>
</template>
<script>
import axios from 'axios'
import MdaPdf from './mda_pdf'
import { mapGetters } from 'vuex'
import swal from 'sweetalert2'
import dataTable from 'datatables.net';
import buttons from "datatables.net-buttons-bs";
import buttons_html5 from "datatables.net-buttons/js/buttons.html5.js";
import InvoicePdf from './invoice_pdf'
import html2canvas from 'html2canvas'
import jsPDF from 'jspdf'
var methods = {}

methods.getData = function() {
  this.loading = true
  const postData = {
    startDate: this.startDate,
    endDate: this.endDate,
    company: this.company
  }
  axios.post('/api/getInvoice', postData).then(response => {
    if (response.status === 200) {
      console.log(response)
      this.data = response.data
      this.loading = false
      this.$emit('data-set')
    }
  })
}

methods.getCompanies = function() {
  axios.post('/api/getCompanies').then(response => {
    console.log(response)
    this.companies = response.data
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

methods.submitInvoice = function () {
  var that = this
  swal({
      title: 'Are you sure?',
      text: "You want to submit this invoice?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#66cc99',
      cancelButtonColor: '#ff6666',
      confirmButtonText: 'Go to cart.',
      cancelButtonText: 'Enter another.',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-info'
  }).then(function(e) {
      console.log(e)
      if (e.value) {
        var company_contact_email = ''
        that.companies.forEach(function (val) {
          if (val.company === that.company) {
            company_contact_email = val.company_contact_email
          }
        })
        const postData = {
          user_name: that.user.name,
          user_id: that.user.id,
          company: that.company,
          company_contact_email: company_contact_email
        }
        axios.post('/api/getInvoiceNumber', postData).then(response => {
          if (response.status === 200 || response.status === 201) {
            that.invoice_number = response.data.id

            setTimeout(function () {
              that.showPdfFunction()
            }, 1000)
          }
        })
      } else if (e.dismiss === 'cancel') {
        
      }
  })
}

methods.showPdfFunction = function () {

    html2canvas(document.querySelector("#invoiceOrdersWrapper")).then(canvas => {  
      var dataURL = canvas.toDataURL("image/jpeg", 1.0);
      // $('#creditImage').val(dataURL)
      // window.open(dataURL)
      var pdf = new jsPDF('portrait', undefined, [2550, 3300]);
      // var pdf = new jsPDF({
      //   orientation: 'portrait',
      //   unit: 'in',
      //   format: [11, 8.5]
      // })
      var w = 2550 * 300 / 25.4
      var l = 3300 * 300 / 25.4
        pdf.addImage(dataURL, 'jpeg', 0, 0, 2550, 3300); //addImage(image, format, x-coordinate, y-coordinate, width, height)
        // pdf.save("PDF");
        pdf = pdf.output('datauristring')
      var request = new XMLHttpRequest()
      var formData = new FormData()
      console.log(pdf)
      var that = this

      formData.append('image', pdf)
      formData.append('invoice_id', this.invoice_number)
      formData.append('orders', JSON.stringify(this.data))
        // var comments = new FormData()
        // console.log(comments)
        request.open('post', '/api/submitInvoice')
    request.send(formData)

    request.addEventListener("load", function(data) {
            console.log(data)
            if (data.currentTarget.status === 200) {
                // that.$router.push('/')
                swal({
          title: 'Success!',
          html: 'You have successfully submitted for review.',
          timer: 1500,
          type: 'success',
        }).then((result) => {
            // that.$router.push('/forms_table')
        })

            } else {
                // that.$router.push('/500')
                swal('Error!', 'Something went wrong...', 'error')
            }
        })
  });
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
      clickedOrder: null,
      startDate: '',
      endDate: '',
      company: '',
      companies: null,
      company_emails: null,
      printInvoice: false,
      invoice_number: ''
    }
  },
  components: {
    MdaPdf,
    InvoicePdf
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  mounted: function() {
    // this.getOrders()
    this.getCompanies()
    var table = null
    this.$on('data-set', function() {
      setTimeout(function() {
        table = $('#invoice_table').dataTable({
          "ordering": true,
          "destroy": true,
          // "dom": 'Bfti',
          "lengthMenu": [
            [-1],
            ['All']
          ],
          "dom": '<"m-t-10"B><"pull-left m-t-10">t<"m-t-10"><"pull-right m-t-10"i>',
          buttons: [
            'copy', 'csv'
          ]
        })
      }, 0)
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
    width: 100%;
    height: 100%;
    padding-bottom: 50px;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: scroll;
    z-index: 1051;

    .background {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, .3);
      z-index: 1052;
    }

    #mdaWrapper {
      position: absolute;
      background-color: #e0e0e0;
      padding-top: 50px;
      width: 8.5in;
      height: auto;
      overflow-y: scroll;
      // top:50px;
      left: calc((100% - 8.5in) / 2);
      right: calc((100% - 8.5in) / 2);
      z-index: 1053;

      img {
        margin-left: calc((100% - 8.5in) / 2);
      }
    }
  }
}

</style>
