<template>
    <div id="formDisplay">
    	<div id="form" v-if="form">
    		<form method="POST" v-on:submit.prevent="submit()">
	            <fieldset>
	                <div class="col-12">
	                    <h3>Company Info</h3>
	                    <div class="col-12">
	                        <ul>
	                            <li>Company: {{form.company}}</li>
	                            <li>Contact: {{form.user_name}}</li>
	                            <li>Email: {{form.user_email}}</li>
	                        </ul>
	                    </div>
	                </div>
	            </fieldset>
	            <fieldset>
	                <div class="col-12">
	                    <h3>Subject Property</h3>
	                    <div class="col-12">
	                        <ul>
	                            <li>Owner/Purchaser: {{form.property_owner}}</li>
	                            <li>Address: {{form.property_address}}, {{form.city}}, {{form.state}} {{form.zip}}</li>
	                            <li>Bedrooms: {{form.bedrooms}}</li>
	                            <li>Bathrooms: {{form.bathrooms}}</li>
	                            <li>Sq Feet: {{form.square_feet}}</li>
	                            <li>Lot Size: {{form.lot_size}}</li>
	                            <li>Year Built: {{form.year_built}}</li>
	                            <li>Basement: {{form.basement}}</li>
	                            <li>Comments: {{form.additional_comments}}</li>
	                        </ul>
	                    </div>
	                </div>
	            </fieldset>
	            <fieldset v-if="form.status === 'canceled'">
	            	<div class="col-12">
	            		<h3>Reason For Canceling</h3>
	            		<div class="col-12">
	            			<textarea v-model="form.rejected_reason" class="form-control" disabled></textarea>
	            		</div>
	            	</div>
	            </fieldset>
	            <fieldset v-if="form.comp_1 && form.comp_2 && form.comp_3">
	                <div class="col-12">
	                    <h3>Property Comps</h3>
	                    <div class="col-12">
	                        <table class="table">
	                            <thead>
	                                <tr>
	                                    <th></th>
	                                    <th style="text-align:center;">Comp 1</th>
	                                    <th style="text-align:center;">Comp 2</th>
	                                    <th style="text-align:center;">Comp 3</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <tr>
	                                    <td>Address</td>
	                                    <td>
	                                        <input type="text" tabindex="1" class="form-control" v-model="form.comp_1.address" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="12" class="form-control" v-model="form.comp_2.address" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="23" class="form-control" v-model="form.comp_3.address" />
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Total Rooms</td>
	                                    <td>
	                                        <input type="text" tabindex="2" class="form-control" v-model="form.comp_1.total_rooms" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="13" class="form-control" v-model="form.comp_2.total_rooms" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="24" class="form-control" v-model="form.comp_3.total_rooms" />
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Square Feet</td>
	                                    <td>
	                                        <input type="text" tabindex="3" class="form-control" v-model="form.comp_1.square_feet" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="14" class="form-control" v-model="form.comp_2.square_feet" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="25" class="form-control" v-model="form.comp_3.square_feet" />
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Bedrooms</td>
	                                    <td>
	                                        <input type="text" tabindex="4" class="form-control" v-model="form.comp_1.bedrooms" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="15" class="form-control" v-model="form.comp_2.bedrooms" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="26" class="form-control" v-model="form.comp_3.bedrooms" />
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Bathrooms</td>
	                                    <td>
	                                        <input type="text" tabindex="5" class="form-control" v-model="form.comp_1.bathrooms" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="16" class="form-control" v-model="form.comp_2.bathrooms" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="27" class="form-control" v-model="form.comp_3.bathrooms" />
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Lot Size</td>
	                                    <td>
	                                        <input type="text" tabindex="6" class="form-control" v-model="form.comp_1.lot_size" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="17" class="form-control" v-model="form.comp_2.lot_size" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="28" class="form-control" v-model="form.comp_3.lot_size" />
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Basement</td>
	                                    <td>
	                                        <input type="text" tabindex="7" class="form-control" v-model="form.comp_1.basement" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="18" class="form-control" v-model="form.comp_2.basement" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="29" class="form-control" v-model="form.comp_3.basement" />
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Condition</td>
	                                    <td>
	                                        <input type="text" tabindex="8" class="form-control" v-model="form.comp_1.condition" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="19" class="form-control" v-model="form.comp_2.condition" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="30" class="form-control" v-model="form.comp_3.condition" />
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Comments</td>
	                                    <td>
	                                        <textarea tabindex="9" class="form-control" v-model="form.comp_1.comments"></textarea>
	                                    </td>
	                                    <td>
	                                        <textarea tabindex="20" class="form-control" v-model="form.comp_2.comments"></textarea>
	                                    </td>
	                                    <td>
	                                        <textarea tabindex="31" class="form-control" v-model="form.comp_3.comments"></textarea>
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Sale Price</td>
	                                    <td>
	                                        <input type="text" tabindex="10" class="form-control" v-model="form.comp_1.sale_price" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="21" class="form-control" v-model="form.comp_2.sale_price" />
	                                    </td>
	                                    <td>
	                                        <input type="text" tabindex="32" class="form-control" v-model="form.comp_3.sale_price" />
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Sale Date</td>
	                                    <td>
	                                        <input type="date" tabindex="11" class="form-control" v-model="form.comp_1.sale_date" />
	                                    </td>
	                                    <td>
	                                        <input type="date" tabindex="22" class="form-control" v-model="form.comp_2.sale_date" />
	                                    </td>
	                                    <td>
	                                        <input type="date" tabindex="33" class="form-control" v-model="form.comp_3.sale_date" />
	                                    </td>
	                                </tr>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </fieldset>
	            <fieldset v-if="form && form.status !== 'canceled'">
	                <div class="col-12">
	                    <h3>Overview</h3>
	                    <div class="col-12 text-center">
	                        Estimated Market Value: <br />
	                        <input type="text" v-model="form.estimated_market_value" class="form-control" style="width:200px;margin-left:calc((100% - 200px) / 2);margin-top:10px;margin-bottom:10px;" />
	                    </div>
	                </div>
	            </fieldset>
	            <fieldset style="margin-bottom:15px;">
	            	<div class="col-12">
	            		<h3>Images</h3>
	            		<div class="col-12">
	            			<input type="file" name="images" class="dropify" data-max-file-size="10M" data-allowed-file-extensions="pdf png jpg jpeg ai zip xls eps bmp" />
	            		</div>
	            	</div>
	            </fieldset>
	            <div class="col-12 text-center" style="margin-bottom: 15px;" v-if="form && form.status !== 'canceled'">
	                <a class="btn btn-success" @click="showPdf = true">Preview</a>
	                <!-- <button class="btn btn-success" type="submit" >Submit</button> -->
	                <button class="btn btn-error" @click="reject = true">Reject</button>
	            </div>
	            <div class="col-12" v-if="reject">
	                <h2>Reject Reason</h2>
	                <textarea class="form-control" v-model="form.rejected_reason"></textarea>
	                <div class="col-12 text-center">
	                    <button class="btn btn-error" @click="submitReject()">Submit Rejection</button>
	                </div>
	            </div>
	        </form>
	    </div>

        <div id="showPdf" v-if="showPdf">
        	<div class="background" @click="showPdf = false"></div>
        	<div id="mdaWrapper">
        		<div class="col-12 text-center float-left">
        			<a style="float:left;margin-left:auto;margin-right:auto;" class="btn btn-info" @click="showPdfFunction()">Submit For Review</a>
        		</div>
            	<mda-pdf style="float:left;" :form="form"></mda-pdf>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import dropify from "dropify"
import MdaPdf from './mda_pdf'
import html2canvas from 'html2canvas'
import swal from 'sweetalert2'
import jsPDF from 'jspdf'
var methods = {}

methods.submit = function () {
    // const postData = {
    //     form: this.form
    // }
    // axios.post('/api/submitForReview', postData).then(response => {

    // })
    var form = document.querySelector('form')
    var that = this

            var request = new XMLHttpRequest()
            var formData = new FormData(form)
            formData.append('id', this.form.id)
            // var comments = new FormData()
            // console.log(comments)
            formData.append('reject_reason', this.form.reject_reason)
			formData.append('comp_1', this.form.comp_1)
			formData.append('comp_2', this.form.comp_2)
			formData.append('comp_3', this.form.comp_3)
			formData.append('estimated_market_value', this.form.estimated_market_value)
			formData.append('agent', this.form.agent)
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
}

methods.submitReject = function () {
    const postData = {
        form: this.form,
        reject: true
    }
    axios.post('/api/submitForReview', postData).then(response => {

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
        pdf.addImage(dataURL, 'jpeg', 0, 0, 215.9, 279.4); //addImage(image, format, x-coordinate, y-coordinate, width, height)
        // pdf.save("PDF");
        pdf = pdf.output('datauristring')
	    var request = new XMLHttpRequest()
	    var formData = new FormData()
	    console.log(pdf)
	    var that = this

    	formData.append('image', pdf)
    	formData.append('id', this.form.id)
        // var comments = new FormData()
        // console.log(comments)
        formData.append('reject_reason', this.form.reject_reason)
		formData.append('comp_1', JSON.stringify(this.form.comp_1))
		formData.append('comp_2', JSON.stringify(this.form.comp_2))
		formData.append('comp_3', JSON.stringify(this.form.comp_3))
		formData.append('estimated_market_value', this.form.estimated_market_value)
		formData.append('agent', this.form.agent)
        request.open('post', '/api/submitForReview')
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
				  	that.$router.push('/forms_table')
				})

            } else {
                // that.$router.push('/500')
                swal('Error!', 'Something went wrong...', 'error')
            }
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

methods.renderCanvas = function (canvas) {
    var myImage = canvas.toDataURL("image/png");
    // window.open(myImage);
    $('#img').attr('src', myImage);
    return
}

methods.getForm = function () {
	const postData = {
		id: this.id
	}
	axios.post('/api/getForm', postData).then(response => {
		if (response.status === 200) {
			console.log(response)
			this.form = response.data
            if (!this.form.comp_1) {
                this.form.comp_1 = {
                    address: '',
                    total_rooms: '',
                    square_feet: '',
                    bedrooms: '',
                    bathrooms: '',
                    lot_size: '',
                    basement: '',
                    condition: '',
                    comments: '',
                    sale_price: '',
                    sale_date: ''
                }
            }
            if (!this.form.comp_2) {
                this.form.comp_2 = {
                    address: '',
                    total_rooms: '',
                    square_feet: '',
                    bedrooms: '',
                    bathrooms: '',
                    lot_size: '',
                    basement: '',
                    condition: '',
                    comments: '',
                    sale_price: '',
                    sale_date: ''
                }
            }
            if (!this.form.comp_3) {
                this.form.comp_3 = {
                    address: '',
                    total_rooms: '',
                    square_feet: '',
                    bedrooms: '',
                    bathrooms: '',
                    lot_size: '',
                    basement: '',
                    condition: '',
                    comments: '',
                    sale_price: '',
                    sale_date: ''
                }
            }
            var that = this
            setTimeout(function () {
            	that.$emit('data-set')
            }, 500)
		}
	})
}

methods.configureType = function (value) {
    return value.replace('_', ' ')
}

export default {
    name: "FormDisplay",
    props: ['id'],
    data: function () {
    	return {
            form: null,
            reject: false,
            showPdf: false
    	}
    },
    components: {
        MdaPdf
    },
    methods: methods,
    mounted: function() {
    	this.getForm()
    	this.$on('data-set', function () {
    		$('.dropify').dropify();
    	})
    },
    destroyed: function() {

    }
}
</script>
<style lang="scss" scoped>
@media print {
	#formDisplay {
		#showPdf {
			display: block !important;
		}

		#form {
			display: none;
		}
	}
	
}
#formDisplay {
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
