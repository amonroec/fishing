<template>
  <div id="checkout">
    <form method="POST" v-on:submit.prevent="orderCart()">
      <div class="col-12 col-lg-6 text-center float-left">
        <div class="card bg-info-card">
          <div class="card-body">
            <h4 class="card-title">Billing Information</h4>
            <div class="card-body">
              <table class="table">
                <tr>
                  <td>Full Name:</td>
                  <td>
                    <input v-if="!customer" type="text" class="form-control" v-model="billing.full_name" />
                    <div v-else>{{billing.full_name}}</div>
                  </td>
                </tr>
                <tr>
                  <td>Company:</td>
                  <td>
                    <input v-if="!customer" type="text" class="form-control" v-model="billing.company" />
                    <div v-else>{{billing.company}}</div>
                  </td>
                </tr>
                <tr>
                  <td>E-mail:</td>
                  <td>
                    <input v-if="!customer" type="email" class="form-control" v-model="billing.email" />
                    <div v-else>{{billing.email}}</div>
                  </td>
                </tr>
                <tr>
                  <td>Address:</td>
                  <td>
                    <input v-if="!customer" type="text" class="form-control" v-model="billing.address" />
                    <div v-else>{{billing.address}}</div>
                  </td>
                </tr>
                <tr>
                  <td>City:</td>
                  <td>
                    <input v-if="!customer" type="text" class="form-control" v-model="billing.city" />
                    <div v-else>{{billing.city}}</div>
                  </td>
                </tr>
                <tr>
                  <td>State:</td>
                  <td>
                    <!-- <input type="text" maxlength="2" class="form-control" v-model="billing.state" /> -->
                    <select class="form-control" v-model="billing.state">
                      <option value="AL">Alabama</option>
                      <option value="AK">Alaska</option>
                      <option value="AZ">Arizona</option>
                      <option value="AR">Arkansas</option>
                      <option value="CA">California</option>
                      <option value="CO">Colorado</option>
                      <option value="CT">Connecticut</option>
                      <option value="DE">Delaware</option>
                      <option value="DC">District Of Columbia</option>
                      <option value="FL">Florida</option>
                      <option value="GA">Georgia</option>
                      <option value="HI">Hawaii</option>
                      <option value="ID">Idaho</option>
                      <option value="IL">Illinois</option>
                      <option value="IN">Indiana</option>
                      <option value="IA">Iowa</option>
                      <option value="KS">Kansas</option>
                      <option value="KY">Kentucky</option>
                      <option value="LA">Louisiana</option>
                      <option value="ME">Maine</option>
                      <option value="MD">Maryland</option>
                      <option value="MA">Massachusetts</option>
                      <option value="MI">Michigan</option>
                      <option value="MN">Minnesota</option>
                      <option value="MS">Mississippi</option>
                      <option value="MO">Missouri</option>
                      <option value="MT">Montana</option>
                      <option value="NE">Nebraska</option>
                      <option value="NV">Nevada</option>
                      <option value="NH">New Hampshire</option>
                      <option value="NJ">New Jersey</option>
                      <option value="NM">New Mexico</option>
                      <option value="NY">New York</option>
                      <option value="NC">North Carolina</option>
                      <option value="ND">North Dakota</option>
                      <option value="OH">Ohio</option>
                      <option value="OK">Oklahoma</option>
                      <option value="OR">Oregon</option>
                      <option value="PA">Pennsylvania</option>
                      <option value="RI">Rhode Island</option>
                      <option value="SC">South Carolina</option>
                      <option value="SD">South Dakota</option>
                      <option value="TN">Tennessee</option>
                      <option value="TX">Texas</option>
                      <option value="UT">Utah</option>
                      <option value="VT">Vermont</option>
                      <option value="VA">Virginia</option>
                      <option value="WA">Washington</option>
                      <option value="WV">West Virginia</option>
                      <option value="WI">Wisconsin</option>
                      <option value="WY">Wyoming</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Zip Code:</td>
                  <td>
                    <input type="text" maxlength="5" class="form-control" v-model="billing.zip_code" />
                  </td>
                </tr>
              </table>
              <!-- <div v-if="billing.payment_type === 'Credit/Debit'" class="col-12">
                <div class="col-12">
                	<label class="col-12 control-label">Name on Card</label>
                	<input type="text" class="form-control" v-model="card.name_on_card" />
                </div>
                <div class="col-12">
                	<label class="col-12 control-label">Card Number</label>
                	<input type="text" class="form-control" v-model="card.card_number" />
                </div>
                <div class="col-4 float-left">
                	<label class="col-12 control-label">CVC</label>
                	<input type="text" class="form-control" v-model="card.cvc" />
                </div>
                <div class="col-4 float-left">
                	<label class="col-12 control-label">Month</label>
                	<input type="text" class="form-control" v-model="card.expiration_month" />
                </div>
                <div class="col-4 float-left">
                	<label class="col-12 control-label">Year</label>
                	<input type="text" class="form-control" v-model="card.expiration_year" />
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-12 col-lg-6 text-center float-left">
      	<div class="card bg-info-card">
          <div class="card-body">
            <h4 class="card-title">Your Order</h4>
            <div class="card-body">
            	<table class="table" v-if="cartData">
            		<thead>
            			<tr>
            				<th>#</th>
            				<th>ITEM</th>
            				<th>TOTAL</th>
            			</tr>
            		</thead>
            		<tbody>
            			<tr v-for="(value, index) in cartData">
            				<td>{{index + 1}}</td>
            				<td>
            					<label v-show="value.form_type === 'market_analysis'">Market Data Analysis</label><br />
            					<label>{{value.property_owner}}</label><br />
            					<label>{{value.property_address}}</label><br />
            				</td>
            				<td style="line-height:100%;">
            					{{value.pricing}}
            				</td>
            			</tr>
            			<tr>
            				<td>{{cartData.length}}</td>
            				<td> </td>
            				<td>{{computeTotal()}}</td>
            			</tr>
            		</tbody>
            	</table>
              <div class="col-12 text-center mb-2">
                <select required v-model="billing.payment_type" style="width:250px;margin-left:auto;margin-right:auto;" class="form-control">
                  <!-- Conditional based on user -->
                  <option value="">Select Payment Option</option>
                  <!-- <option value="bill_me_later">Bill Me Later</option>
                  <option value="credit/debit">Credit/Debit</option> -->
                  <option v-for="val in paymentOptions" :value="val">{{val}}</option>
                </select>
              </div>
              <!-- <div class="col-12 text-center">
                <button class="btn btn-success" type="submit">Order!</button>
              </div> -->
              <div v-if="billing.payment_type === 'Bill Me Later'" class="col-12 text-center">
                <button class="btn btn-success" type="submit">Order!</button>
              </div>
              <div class="col-12 text-center" v-else-if="billing.payment_type === 'Credit/Debit' && checkFields">
                <button class="btn btn-success" type="submit">Confirm & Pay w/ <i class="fab fa-cc-stripe"></i></button>
              </div>
              <stripe-checkout
                  v-show="false"
                  stripe-key="pk_test_zYHtIgvalM3NFNipQwqLjqIy"
                  :product="product"
                  onSuccess="broadcast"
                  button="Confirm & Pay">
              </stripe-checkout>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div id="confirmLoading" v-show="confirmLoading">
      <div class="background"></div>
      <div id="wrapper">
        <i style="margin-top:150px;" class="fas fa-circle-notch fa-spin"></i><br />
        <span style="font-size:30px;">Redirecting...</span>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import swal from 'sweetalert2'
import { Bus } from 'vue-stripe';

var methods = {}

methods.getCart = function () {
	axios.get('/api/getCart/' + this.user.id).then(response => {
		if (response.status === 200 || response.status === 201) {
			console.log(response)
			this.cartData = response.data
      this.getProduct()
		}
	})
}

methods.changed = function () {
  console.log('changedddddd')
}

// methods.getStripeToken = function () {
//   if (this.billing.payment_type === 'Credit/Debit') {
//     // e.preventDefault();
//     Stripe.setPublishableKey($form.data('stripe-publishable-key'));
//     Stripe.createToken({
//       number: $('.card-number').val(),
//       cvc: $('.card-cvc').val(),
//       exp_month: $('.card-expiry-month').val(),
//       exp_year: $('.card-expiry-year').val()
//     }, stripeResponseHandler);
//   }
// }

methods.orderCart = function () {
  var that = this
  // swal({
  //     title: 'Are you sure?',
  //     text: "Are you sure you want to order every item that's in your cart?",
  //     type: 'warning',
  //     showCancelButton: true,
  //     confirmButtonColor: '#66cc99',
  //     cancelButtonColor: '#ff6666',
  //     confirmButtonText: 'Yes, order it.',
  //     cancelButtonText: 'Cancel.',
  //     confirmButtonClass: 'btn btn-success',
  //     cancelButtonClass: 'btn btn-default'
  // }).then(function(e) {
  //     if (e.value) {
  //       console.log(that.user)
        if (that.user) {
          var postData = {
            data: that.cartData,
            user_id: that.$store.state.auth.user.id,
            billing: that.billing,
            card: that.card
          }
          var route = '/api/orderCart'
        } else {
          var postData = {
            data: that.cartData,
            user_id: 'guest',
            billing: that.billing,
            card: that.card
          }
          var route = '/api/guestOrderCart'
        }
        console.log(postData)
        axios.post(route, postData).then(response => {
          console.log(response)
          if (response.status === 200 || response.status === 201) {
              // swal('Success!', 'You have successfully entered an order.', 'success')
              // window.localStorage.removeItem('cart')
              this.active_order_id = response.data.id
              if (this.billing.payment_type === 'Credit/Debit') {
                document.querySelector('.btn-stripe-checkout').click();
              } else {
                this.confirmLoading = true
                var that = this
                setTimeout(function () {
                  that.$router.push('/order_summary/' + response.data.token)
                  that.confirmLoading = false
                }, 1000)
              }
          }
        })
      // } else if (e.dismiss === 'cancel') {
        
      // }
}

methods.checkFields = function () {
    // var calc = 0
    var otherCalc = 0
    for (var key in this.billing) {
      otherCalc++
    }
    var calc = 3
    if (this.billing.zip_code.length === 5 || this.billing.zip_code.length === 10) {
      calc++
    }
    if (this.billing.state !== '') {
      calc++
    }
    if (this.billing.state.length === 2) {
      calc++
    }
    if (this.billing.email !== '') {
      calc++
    }
    if (this.billing.full_name !== '') {
      calc++
    }
    console.log(calc + ' - ' + otherCalc)
    if (calc === otherCalc) {
      return true
    } else {
      return false
    }
}

methods.confirmOrder = function (token) {
  this.confirmLoading = true
  if (this.active_order_id) {
    if (this.user) {
      var route = '/api/confirmOrderPayment'
    } else {
      var route = '/api/guestConfirmOrderPayment'
    }
    const postData = {
      order_id: this.active_order_id,
      token: token
    }
    axios.post(route, postData).then(response => {
      if (response.status === 200 || response.status === 201) {
        console.log(response)
        var that = this
        setTimeout(function () {
          that.$router.push('/order_summary/' + response.data.token)
        }, 1000)
      }
    })
  } else {
    this.confirmOrder = false
  }
}

methods.computeTotal = function () {
	var calc = 0
	this.cartData.forEach(function (cart) {
		calc += parseInt(cart.pricing)
	})
	return calc
}

methods.getProduct = function () {
  var calc = this.computeTotal()
  var name = ''
  this.cartData.forEach(function (cart) {
    name += cart.property_owner + ' '
  })
  this.product.name = name
  this.product.description = name
  this.product.amount = calc * 100
}

export default {
  name: "Checkout",
  data: function() {
    return {
      active_order_id: null,
      confirmLoading: false,
      customer: false,
      billing: {
        full_name: '',
        address: '',
        city: '',
        state: '',
        zip_code: '',
        email: '',
        company: '',
        payment_type: ''
      },
      card: {
      	name_on_card: '',
      	card_number: '',
      	cvc: '',
      	expiration_month: '',
      	expiration_year: ''
      },
      cartData: null,
      paymentOptions: null,
      product:{
          id: '',
          name:'',
          description:'',
          amount: ''
      }
    }
  },
  methods: methods,
  computed: mapGetters({
    user: 'auth/user'
  }),
  mounted: function() {
    console.log(this.user)
    if (this.user) {
  		  this.getCart()
        if (this.user.is_customer === 'yes') {
          this.customer = true
          this.billing.full_name = this.user.name
          this.billing.company = this.user.company
          this.billing.email = this.user.email
          this.billing.city = this.user.bill_to_city
          this.billing.address = this.user.bill_to_address
          this.billing.state = this.user.bill_to_state
          this.billing.zip_code = this.user.bill_to_zip_code
          this.billing.payment= 'Bill Me Later'
          this.paymentOptions = ['Bill Me Later', 'Credit/Debit']
        } else {
          this.paymentOptions = ['Credit/Debit']
        }
    } else {
      if (window.localStorage.getItem('cart')) {
        this.cartData = JSON.parse(window.localStorage.getItem('cart'))
      } else {
        this.cartData = null
      }
      this.paymentOptions = ['Credit/Debit']
      this.billing.payment_type = 'Credit/Debit'
      this.getProduct()
    }

    this.$on('stripe-success', function () {
      console.log('stripe successsssss')
    })
    var that = this
    setTimeout(function () {
      Bus.$on('vue-stripe.success', payload => {
          console.log(payload)
          that.confirmOrder(payload.token)
      });
      Bus.$on('vue-stripe.not-found', payload => {
          console.log('not-found')
      });
      Bus.$on('vue-stripe.error', payload => {
          console.log('errorrrrrrrr')
      });
    }, 1000)
  },
  // computed: {
  //   'checkFields': function () {
  //     // var calc = 0
  //     var otherCalc = 0
  //     for (var key in this.billing) {
  //       otherCalc++
  //     }
  //     var calc = 3
  //     if (this.billing.zip_code.length === 5 || this.billing.zip_code.length === 10) {
  //       calc++
  //     }
  //     if (this.billing.state !== '') {
  //       calc++
  //     }
  //     if (this.billing.state.length === 2) {
  //       calc++
  //     }
  //     if (this.billing.email !== '') {
  //       calc++
  //     }
  //     if (this.billing.full_name !== '') {
  //       calc++
  //     }
  //     console.log(calc + ' - ' + otherCalc)
  //     if (calc === otherCalc) {
  //       return true
  //     } else {
  //       return false
  //     }
  //   }
  // },
  destroyed: function() {

  }
}

</script>
<style lang="scss" scoped>
#checkout {

  #confirmLoading {
    position: fixed;
    top:0;left:0;right:0;bottom:0;
    width:100%;
    height:100%;

    .background {
      position: fixed;
      top:0;left:0;right:0;bottom:0;
      width:100%;
      height:100%;
      background-color: rgba(0,0,0,.3);
      z-index: 100;
    }

    #wrapper {
      position: absolute;
      top:0;left:0;right:0;bottom:0;
      width:100%;
      height:100%;
      text-align:center;
      font-size:50px;
      color:#fff;
      z-index: 101;

      i {

      }
    }
  }
}
</style>