<template>
  <div id="contact_us">
    <div class="col-sm-12 col-md-8 col-lg-8" id="formWrapper">

      <card style="width:100%;text-align:center;" :title="computeTitle()">
        <form method="POST" @submit.prevent="submitForm()">
        	<input type="hidden" name="form_type" v-model="type" />
        	<input type="hidden" name="pricing" v-model="form.pricing" />
        	<input v-if="user" type="hidden" name="user_id" v-model="user.id" />

          <h4 style="color:#ccc;">A quick and easy market analysis for the real estate property of your liking.</h4>
          <hr style="width:75px;height:2px;background-color:#000;border:1px solid #000;margin-top:45px;margin-bottom:45px;" />

          <div id="priceValues" v-if="form.turnaround !== ''" class="col-12">
            <div class="col-12" style="margin-bottom: 15px;" v-if="user">
              <span v-if="form.turnaround === 'standard' && !user.is_customer">$75</span>
              <span v-else-if="form.turnaround === 'rush' && !user.is_customer">$85</span>
              <span v-else-if="form.turnaround === 'standard' && user.is_customer && type === 'comps_only'">${{user.pricing_comps_only}}</span>
              <span v-else-if="form.turnaround === 'standard' && user.is_customer === 'yes'">${{user.pricing_standard}}</span>
              <span v-else-if="form.turnaround === 'rush' && user.is_customer === 'yes'">${{user.pricing_rush}}</span>
              <span v-else-if="form.turnaround === 'drive_by_1' && user.is_customer === 'yes'">${{user.pricing_drive_by_1}}</span>
              <span v-else-if="form.turnaround === 'drive_by_2' && user.is_customer === 'yes'">${{user.pricing_drive_by_2}}</span>
              <span v-else-if="form.turnaround === 'drive_by_3' && user.is_customer === 'yes'">${{user.pricing_drive_by_3}}</span>
              <span v-else-if="form.turnaround === 'standard' && user.is_customer === 'no'">$75</span>
              <span v-else-if="form.turnaround === 'rush' && user.is_customer === 'no'">$85</span>
            </div>
            <div class="col-12" style="margin-bottom: 15px;" v-else>
              <span v-if="form.turnaround === 'standard'">$75.00</span>
              <span v-else-if="form.turnaround === 'rush'">$85.00</span>
            </div>
          </div>

          <!-- <div v-if="!user" class="col-12 form-group">
            <div class="col-4 label">
              User Name
            </div>
            <div class="col-8 values">
              <input type="text" name="user_name" v-model="form.user_name" class="form-control" />
            </div>
          </div>

          <div v-if="!user" class="col-12 form-group">
            <div class="col-4 label">
              User Email
            </div>
            <div class="col-8 values">
              <input type="text" name="user_email" v-model="form.user_email" class="form-control" />
            </div>
          </div> -->

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              {{type === 'market_analysis' || type === 'comps_only' ? 'Turnaround' : 'County'}}
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <select :disabled="disabled" class="form-control" name="turnaround" required v-model="form.turnaround">
                <option value="">Choose an Option</option>
                <option v-for="option in turnaroundOptions" :value="option.value">{{option.text}}</option>
                <!--<option value="standard">Standard (~ 3 Days)</option>
                <option value="rush">Rush (1 Business Day)</option>-->
              </select>
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Property Owner / Info
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="property_owner" v-model="form.property_owner" class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 labelRequired">
              Property Address
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="property_address" v-model="form.property_address" required class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Parcel ID
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="parcel_id" v-model="form.parcel_id" class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label labelRequired">
              City
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="city" v-model="form.city" required class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label labelRequired">
              State
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <select :disabled="disabled" class="form-control" name="state" v-model="form.state">
                <option value="MO">Missouri</option>
                <option value="IL">Illinois</option>
              </select>
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label labelRequired">
              Zip
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="zip" v-model="form.zip" required class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Zoning
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <select :disabled="disabled" class="form-control" name="zoning" v-model="form.zoning">
                <option value="Agricultural">Agricultural</option>
                <option value="Commercial">Commercial</option>
                <option value="Residential">Residential</option>
              </select>
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Bedrooms
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="bedrooms" v-model="form.bedrooms" class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Bathrooms
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="bathrooms" v-model="form.bathrooms" class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Square Feet
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="square_feet" v-model="form.square_feet" class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Lot Size
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="lot_size" v-model="form.lot_size" class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Basement
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <select :disabled="disabled" class="form-control" name="basement" v-model="form.basement">
                <option value="None">None</option>
                <option value="Unfinished">Unfinished</option>
                <option value="Finished">Finished</option>
              </select>
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Year Built
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <input :disabled="disabled" type="text" name="year_built" v-model="form.year_built" class="form-control" />
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Condition
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <select :disabled="disabled" class="form-control" name="condition" v-model="form.condition">
                <option value="Good">Good</option>
                <option value="Fair">Fair</option>
                <option value="Poor">Poor</option>
                <option value="NA">N/A (farm, land, etc..)</option>
              </select>
            </div>
          </div>

          <div class="col-12 form-group">
            <div class="col-sm-12 col-md-4 col-lg-4 label">
              Additional Comments
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 values">
              <textarea :disabled="disabled" name="additional_comments" v-model="form.additional_comments" class="form-control"></textarea>
            </div>
          </div>

          <button v-if="!disabled" type="submit" class="btn btn-success" style="margin-left:auto;margin-right:auto;margin-top:15px;">Add to Cart</button>
        </form>
        <button v-if="!disabled" @click="saveForm()" class="btn btn-info" style="margin-left:auto;margin-right:auto;margin-top:15px;">Save Form</button>
      </card>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'
import swal from 'sweetalert2'
var methods = {}

methods.submitForm = function () {
  console.log(this.form)
  this.form.form_type = this.type
  if (this.user) {
    this.form.user_id = this.user.id
    if (this.form.turnaround === 'drive_by_1' && this.user.is_customer === 'yes') {
      this.form.pricing = this.user.pricing_drive_by_1
    } else if (this.form.turnaround === 'drive_by_2' && this.user.is_customer === 'yes') {
      this.form.pricing = this.user.pricing_drive_by_2
    } else if (this.form.turnaround === 'drive_by_3' && this.user.is_customer === 'yes') {
      this.form.pricing = this.user.pricing_drive_by_3
    } else if (this.form.turnaround === 'standard' && this.user.is_customer === 'yes') {
      this.form.pricing = this.user.pricing_standard
    } else if (this.form.turnaround === 'rush' && this.user.is_customer === 'yes') {
      this.form.pricing = this.user.pricing_rush
    } else if (this.form.turnaround === 'standard' && this.user.is_customer === 'no') {
      this.form.pricing = 75
    } else if (this.form.turnaround === 'rush' && this.user.is_customer === 'no') {
      this.form.pricing = 85
    }

    if (this.user.is_customer === 'yes') {
      this.form.company = this.user.company
      this.form.branch = this.user.branch
      this.form.company_contact_name = this.user.company_contact_name
      this.form.company_contact_email = this.user.company_contact_email
    }

    const postData = {
      form: this.form
    }
    var that = this
    axios.post('/api/addToCart', postData).then(response => {
      console.log(response)
      if (response.status === 201) {
        // this.$router.push('/cart')
        swal({
            title: 'Success!',
            text: "You have added an order to your cart. Take you to your cart to checkout or enter another order?",
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
              that.$router.push('/cart')
            } else if (e.dismiss === 'cancel') {
              that.$router.push('/market_analysis_form')
            }
        })
      }
    })
  } else {
    if (!window.localStorage.getItem('cart')) {
      var cart = [this.form]
      window.localStorage.setItem('cart', JSON.stringify(cart))
    } else {
      var cart = JSON.parse(window.localStorage.getItem('cart'))
      cart.push(this.form)
      window.localStorage.setItem('cart', JSON.stringify(cart))
    }
    var that = this
    swal({
          title: 'Success!',
          text: "You have added an order to your cart. Take you to your cart to checkout or enter another order?",
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
            that.$router.push('/cart')
          } else if (e.dismiss === 'cancel') {
            that.$router.push('/market_analysis_form')
          }
      })
  }
}

methods.computeTitle = function () {
	if (this.type === 'market_analysis') {
		return 'Market Analysis Form'
	} else if (this.type === 'comps_only') {
		return 'Comps Only'
	} else if (this.type === 'drive_by') {
		return 'Drive-By Market Price Opinion'
	}
}

methods.saveForm = function () {
  window.localStorage.setItem('form', JSON.stringify(this.form))
}

export default {
  name: 'MarketForm',
  props: ['type', 'data', 'disabled'],
  data: function () {
    return {
      form: {
        turnaround: '',
        form_type: '',
        user_id: '',
        property_owner: '',
        property_address: '',
        county: '',
        parcel_id: '',
        city: '',
        state: 'MO',
        zip: '',
        zoning: 'Residential',
        bedrooms: '',
        bathrooms: '',
        square_feet: '',
        lot_size: '',
        basement: 'None',
        year_built: '',
        condition: 'Good',
        additional_comments: '',
        pricing: '',
        user_name: '',
        user_email: '',
        company: null,
        branch: null,
        company_contact_name: null,
        company_contact_email: null
      },
      turnaroundOptions: null,
      county_options: []
    }
  },

  computed: mapGetters({
    user: 'auth/user'
  }),

  watch: {
  	'form.turnaround': function () {
      if (this.user) {
        if (this.form.turnaround === 'standard' && !this.user.is_customer) {
        	this.form.pricing = '75'
        } else if (this.form.turnaround === 'rush' && !this.user.is_customer) {
        	this.form.pricing = '85'
        } else if (this.form.turnaround === 'standard' && this.user.is_customer && this.type === 'comps_only') {
        	this.form.pricing = this.user.pricing_comps_only
        } else if (this.form.turnaround === 'standard' && this.user.is_customer) {
        	this.form.pricing = this.user.pricing_standard
        } else if (this.form.turnaround === 'rush' && this.user.is_customer) {
        	this.form.pricing = this.user.pricing_rush
        }
      } else {
        if (this.form.turnaround === 'standard') {
          this.form.pricing = '75'
        } else if (this.form.turnaround === 'rush') {
          this.form.pricing = '85'
        }
      }
  	},
    'form.county': function () {
      if (this.form.turnaround === 'drive_by_1' && this.user.is_customer) {
        this.form.pricing = this.user.pricing_drive_by_1
      } else if (this.form.turnaround === 'drive_by_2' && this.user.is_customer) {
        this.form.pricing = this.user.pricing_drive_by_2
      } else if (this.form.turnaround === 'drive_by_3' && this.user.is_customer) {
        this.form.pricing = this.user.pricing_drive_by_3
      }
    }
  },

  mounted: function () {
  	console.log(this.$router)
    var that = this
    if (this.data) {
      this.form = this.data
      this.type = this.form.form_type
    } else {
      if (window.localStorage.getItem('form')) {
        var form = JSON.parse(window.localStorage.getItem('form'))
          swal({
              title: 'Sweet!',
              text: "It looks like you've saved a past form. Would you like to use it? Click out of the box if you don't want it to be removed.",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#66cc99',
              cancelButtonColor: '#ff6666',
              confirmButtonText: 'Yes, use it!',
              cancelButtonText: 'Nope, remove it!',
              confirmButtonClass: 'btn btn-success',
              cancelButtonClass: 'btn btn-danger'
          }).then(function(e) {
              console.log(e)
              if (e.value) {
                that.form = form
              } else if (e.dismiss === 'cancel') {
                window.localStorage.removeItem('form')
              }
          })
      }
    }
    console.log(this.type)
  		if (this.type === 'market_analysis') {
  			this.turnaroundOptions = [
  				{value: 'standard', text: 'Standard (~3 Business Days)'},
  				{value: 'rush', text: 'Rush (1 Business Day)'}
  			]
  		} else if (this.type === 'comps_only') {
  			this.turnaroundOptions = [
  				{value: 'standard', selected: true, text: 'Standard (~3 Business Days)'}
  			]
  		} else if (this.type === 'drive_by') {
  			this.turnaroundOptions = [
  				{value: 'drive_by_1', text: 'Crawford, Franklin, Gasconade, Phelps, Washington'},
  				{value: 'drive_by_2', text: 'Dent, Iron, Jefferson, Lincoln, Maries, Montgomery, Osage, Ste Genevieve, St Charles, St Francois, St Louis, St Louis City, Warren'},
  				{value: 'drive_by_3', text: 'Pike'}
  			]
  		}
  },

  methods: methods
}
</script>
<style lang="scss" scoped>
#contact_us {
  width: 100%;
  height: auto;
  padding-bottom:80px;


  #formWrapper {
    text-align:center;
    margin-left:auto;
    margin-right:auto;

    #priceValues {
      text-align: center;
      color: red;
      font-weight: bold;
      font-size: 35px;
    }

    h3 {
      color: #fff;
      padding-top: 25px;
      font-weight:bold;
    }

    form {
      width:100%;

      .form-group {
        float:left;

        .labelRequired {
          &:after {
            content: '*';
            color: red;
          }
        }

        .label {
          text-align:right;
          padding-right:10px;
        }

        div {
          float:left;
        }
      }
    }
  }
}
</style>
