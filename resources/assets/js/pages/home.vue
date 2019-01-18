<template>
  <!-- <card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
  </card> -->
  <div style="margin-top: -1.5rem !important;">

  	<!-- Image transitioner -->
	  <div class="transition-images">
	  	<!-- <img v-show="imageShowing === 'blueSky'" width="1000" height="600" src="./../../images/AdobeStock_63793591.jpeg" />
	  	<img v-show="imageShowing === 'houses'" width="1000" height="600" src="./../../images/AdobeStock_783529.jpeg" /> -->
	  	<div id="overlay"></div>
	  	<div id="buttonWrapper">
	  		<h3><b>Quick & Easy <br /> Market Data Analysis</b></h3>

	  		<h5>Get real, recent, and relevant market data analyses with ease!</h5>

	  		<div class="col-12" style="padding-top:15px;">
	  			<button class="btn sign-up-button" @click="goToSignUp()">SIGN UP NOW</button>
	  			<button class="btn new-mda-button" @click="goToMDA()">START NEW MDA</button>
	  		</div>
	  	</div>
	  </div>

	  <!-- State information (second row of home page) -->
	  <div class="col-12" style="float:left;" id="stateData">
	  		<h4>Illinois and Missouri’s online resource for <span>Real Estate Market Data</span></h4>
	  		<h5>Submit your data analysis request in minutes. Get detailed comp lists of relevant homes/properties and market values in as quickly as 1 business day. Sign up to make an account and track your orders online.</h5>
	  </div>

	  <!-- INFO Wrapper with the 3 icons inside of it -->
	  <div class="col-12" style="float:left;" id="iconWrapper">
	  		<div class="col-12 col-md-4 col-lg-4 emblemWrapper">
	  			<img src="./../../images/003-search.png" height="64" width="64"/>
	  			<h5 class="labels">Order In Seconds</h5>
	  			<h5 class="info">Just fill out a quick form to give us the details of your subject home, business, or property. We’ll use it to find you the most similar properties recently on the market.</h5>
	  		</div>
	  		<div class="col-12 col-md-4 col-lg-4 emblemWrapper">
	  			<img src="./../../images/002-devices.png" height="64" width="64"/>
	  			<h5 class="labels">Mobile Friendly</h5>
	  			<h5 class="info">Made for ease of use, no matter the device. Log in, submit orders, and view and manage past orders on any computer, tablet, or phone.</h5>
	  		</div>
	  		<div class="col-12 col-md-4 col-lg-4 emblemWrapper">
	  			<img src="./../../images/001-contract.png" height="64" width="64"/>
	  			<h5 class="labels">Quick Turnaround</h5>
	  			<h5 class="info">In just a couple of business days (or 1 for rush orders) you will get a detailed comp list of the most relevant properties to you, helping you more accurately gauge the value.</h5>
	  		</div>
	  </div>

	  <!-- Enterprise Options -->
	  <div style="float:left;" id="enterpriseWrapper">
	  	<!-- <img style="width:100%;height:100%;" src="./../../images/imageedit_2_7172783266.jpg" /> -->
	  	<div id="imageWrapper"></div>
	  	<div id="textWrapper">
	  		<h4 id="topText">For companies or large volumes...</h4>
	  		<h2 id="midText">ENTERPRISE OPTIONS</h2>
	  		<hr style="width:150px;background-color:#fff;margin-top:50px;margin-bottom:50px;" />
	  		<h4 id="bottomText">For enterprise rates and accounts use the contact form below to explain your situation. Whether you need 10 or 1000 per month, Market Price Opinion is your solution for getting quick and reliable real estate market data analyses.</h4>
	  	</div>
	  </div>


	  <!-- Store info wrapper -->
	  <div class="col-12" style="float:left;" id="storeWrapper">
	  		<div class="col-12 col-md-4 col-lg-4 moneyWrapper">
	  			<p>Basic</p>
	  			<h5 class="money">$75</h5>
	  			<h5 class="belowMoney">Each</h5>
	  			<h5 class="infoText">1-3 business day turnaround</h5>
	  			<h5 class="infoText">Tailored market research</h5>
	  			<h5 class="infoText">Easy estimated market value</h5>
	  			<button class="btn btn-secondary" @click="$router.push('/market_analysis_form')">Store</button>
	  		</div>
	  		<div class="col-12 col-md-4 col-lg-4 moneyWrapper">
	  			<p>Rush</p>
	  			<h5 class="money">$85</h5>
	  			<h5 class="belowMoney">Each</h5>
	  			<h5 class="infoText">0-1 business day turnaround</h5>
	  			<h5 class="infoText">Get pressing request processed immediately</h5>
	  			<h5 class="infoText">Same detailed data provided</h5>
	  			<button class="btn btn-secondary" @click="$router.push('/market_analysis_form')">Store</button>
	  		</div>
	  		<div class="col-12 col-md-4 col-lg-4 moneyWrapper">
	  			<p>Enterprise</p>
	  			<h5 class="money">Bulk</h5>
	  			<h5 class="belowMoney">Rates</h5>
	  			<h5 class="infoText">Great for high volume users</h5>
	  			<h5 class="infoText">Create multiple users</h5>
	  			<h5 class="infoText">Flexible payment options</h5>
	  			<button class="btn btn-secondary" @click="$router.push('/contact_us')">Contact Us</button>
	  		</div>
	  </div>

	  <div style="float:left;width:100%;">
	  	<contact-us></contact-us>
	  </div>

	</div>
</template>

<script>
import ContactUs from './contact_us'
var methods = {}

methods.startInterval = function () {
	var that = this
	setInterval(function() {
		if (that.imageShowing === 'blueSky') {
			that.imageShowing = 'houses'
			$('.transition-images').css('background', "url('./../../images/AdobeStock_63793591.jpeg') no-repeat bottom center")
		} else {
			that.imageShowing = 'blueSky'
			$('.transition-images').css('background', "url('./../../images/AdobeStock_783529.jpeg') no-repeat center center")
		}
		$('.transition-images').css('-webkit-background-size', 'cover')
	  $('.transition-images').css('-moz-background-size', 'cover')
	  $('.transition-images').css('-o-background-size', 'cover')
	  $('.transition-images').css('background-size', 'cover')
	}, 5000);
}

methods.goToSignUp = function () {
	this.$router.push('/register')
}

methods.goToMDA = function () {
	this.$router.push('/market_analysis_form')
}

export default {
  // middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: function () {
  	return {
  		imageShowing: 'houses'
  	}
  },
  components: {
  	ContactUs
  },
  mounted: function () {
  	this.startInterval()
  },
  methods: methods
}
</script>
<style lang="scss" scoped>
.transition-images {
	position:relative;
	height: calc(100vh - 100px);
	min-width: 100%;
	float:left;
	background-color: black;
	overflow: hidden;
	background: url('./../../images/AdobeStock_63793591.jpeg') no-repeat bottom center;
	-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;

	img {
		width: 100%;
		position:relative;
	}

	#overlay {
		position:absolute;
		top:0;left:0;right:0;bottom:0;
		width:100%;height:100%;
		background-color: rgba(0,0,0,.5);
		z-index: 1;
	}
}

#buttonWrapper {
	position: absolute;
	width: 500px;
	height:auto;
	bottom:20%;left:5%;
	z-index: 2;
	padding:20px;
	background-color: white;
	border-radius: 10px;

	h3 {
		font-size:35px;
		color: #000;
	}
	h5 {
		font-size:15px;
		font-weight: bold;
		color:#000;
	}
	.sign-up-button {
		background-color: #D82E20;
		color: darken(#D82E20, 35%);
		font-weight:bold;
	}
	.new-mda-button {
		background-color: #429347;
		color: darken(#429347, 25%);
		font-weight:bold;
		margin-left: 8px;
	}
	button {
		&:hover {
			opacity: .8;
		}
	}
}

#stateData {
	background-color: #f9f9f9;
	text-align: center;
	float:left;
	height:auto;
	padding-top: 55px;
	padding-bottom:55px;

	h4 {
		font-weight:bold;
		color: #444444;

		span {
			color: #169540;
		}
	}

	h5 {
		margin-top:25px;
		color: #777272;
		font-size:15px;
	}
}

#iconWrapper {
	background-color: #fff;
	// padding-top: 25px;

	.emblemWrapper {
		text-align:center;
		float:left;
		padding:25px;

		.labels {
			margin-top: 15px;
			font-size:15px;
			font-weight: bold;
			text-transform: uppercase;
		}

		.info {
			color: #999999;
			font-size:14px;
		}
	}
}

#enterpriseWrapper {
	// background: url('./../../images/imageedit_2_7172783266.jpg') no-repeat center center;
	text-align:center;
	position:relative;
	min-height:415px;
	height: auto;
	// padding:25px;
	width:100%;
	// -webkit-background-size: cover;
 //  -moz-background-size: cover;
 //  -o-background-size: cover;
 //  background-size: cover;

  #imageWrapper {
  	position:absolute;
  	background: url('./../../images/imageedit_2_7172783266.jpg') no-repeat center center;
  	top:0;right:0;left:0;bottom:0;
  	width:100%;height:100%;
  	-webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;
	  z-index:1;
  }

	#textWrapper {
		position: relative;
		// top:0;right:0;left:0;bottom:0;
		width:100%;
		height:100%;
		background-color: rgba(0,0,0,.5);
		z-index:2;
		padding-top:80px;
		padding-bottom: 80px;

		#topText {
			color: #B0B0AE;
			font-size:30px;
			font-style: italic;
		}

		#midText {
			color: #fff;
			font-size:60px;
		}

		#bottomText {
			color: #fff;
			font-size: 15px;
			width:60%;
			margin-left:20%;
		}
	}
}

#storeWrapper {
	float:left;
	padding-top: 40px;
	padding-bottom: 40px;

		.moneyWrapper {
			float:left;
			text-align: center;

			&:hover {
				button {
					background-color: green;
				}
				p {
					color: green;
				}
			}

			button {
				margin-top: 25px;
				margin-bottom: 25px;
			}

			.money {
				margin-top:45px;
				font-size: 30px;
				font-weight: bold;
			}
			.belowMoney {
				font-size:12px;
				color: grey;
				margin-bottom: 45px;
			}
			.infoText {
				font-size:15px;
				color: grey;
				padding: 5px;
			}
		}
}
</style>
