<template>
  <div class="col-12 p-0" id="mdaPdf" style="height:auto;">
    <div class="card bg-info-card" v-if="form">
      <div class="card-body">
        <div style="width:20%;float:left;text-align:center;">
          <img style="height:70px;" src="./../../images/pdf_logo.png" />
    			</div>
          <div style="width:60%;height:70px;float:left;text-align:center;">
            <h3 style="height:100%;line-height:70px;">
	    				Market Data Analysis
	    			</h3>
          </div>
          <div class="col-12 wrapper">
            <h4>Subject Property</h4>
            <div class="insideInfo" style="margin-top:18px;">
              <div class="pdfContainer">
                <div class="leftLabel">Owner/Purchaser:</div>
                <div class="rightData">
                  <div class="answer">
                    {{form.property_owner}}
                  </div>
                  <div class="labels"></div>
                </div>
              </div>
              <div class="pdfContainer">
                <div class="leftLabel">Address:</div>
                <div class="rightData">
                  <div class="answer">
                    <div class="street">{{form.property_address}}</div>
                    <div class="city">{{form.city}}</div>
                    <div class="state">{{form.state}}</div>
                    <div class="zip">{{form.zip}}</div>
                  </div>
                  <div class="labels">
                    <div class="street">Street Address</div>
                    <div class="city">City</div>
                    <div class="state">State</div>
                    <div class="zip">Zip</div>
                  </div>
                </div>
              </div>
              <div class="pdfContainer">
                <div class="leftLabel">Details:</div>
                <div class="rightData">
                  <div class="answer">
                    <div class="bedrooms">{{form.bedrooms}}</div>
                    <div class="bathrooms">{{form.bathrooms}}</div>
                    <div class="sq_ft">{{form.square_feet}}</div>
                    <div class="lot">{{form.lot_size}}</div>
                  </div>
                  <div class="labels">
                    <div class="bedrooms">Bedrooms</div>
                    <div class="bathrooms">Bathrooms</div>
                    <div class="sq_ft">Sq Ft.</div>
                    <div class="lot">Lot</div>
                  </div>
                </div>
              </div>
              <div class="pdfContainer">
                <div class="leftLabel"></div>
                <div class="rightData" style="width:50%;">
                  <div class="answer">
                    <div class="year">{{form.year_built}}</div>
                    <div class="basement">{{form.basement}}</div>
                  </div>
                  <div class="labels">
                    <div class="year">Year Built</div>
                    <div class="basement">Basement</div>
                  </div>
                </div>
              </div>
              <div class="pdfContainer">
                <div class="leftLabel">Comments:</div>
                <div class="rightData">
                  <div class="answer" id="commentsAnswer">
                  </div>
                  <!-- <div class="labels">

	    						</div> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 wrapper">
            <h4>Company Info</h4>
            <div class="insideInfo" style="margin-top:18px;">
              <div class="pdfContainer">
                <div class="leftLabel">Company:</div>
                <div class="rightData">
                  <div class="answer">
                  	<div class="customer_name">{{form.company || ''}}</div>
                    <div class="branch">{{form.branch || ''}}</div>
                  </div>
                  <div class="labels">
                    <div class="customer_name">Name</div>
                    <div class="branch">Branch</div>
                  </div>
                </div>
              </div>
              <div class="pdfContainer">
                <div class="leftLabel">Contact:</div>
                <div class="rightData">
                  <div class="answer">
                  	<div class="name">{{form.company_contact_name || ''}}</div>
                    <div class="email">{{form.company_contact_email || ''}}</div>
                  </div>
                  <div class="labels">
                    <div class="name">Name</div>
                    <div class="email">Email</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 wrapper" v-if="!cancel">
            <h4>Property Comps</h4>
            <div class="insideInfo" style="margin-top:18px;">
              <div class="pdfContainer">
                <table>
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
                        {{form.comp_1.address}}
                      </td>
                      <td>
                        {{form.comp_2.address}}
                      </td>
                      <td>
                        {{form.comp_3.address}}
                      </td>
                    </tr>
                    <tr>
                      <td>Total Rooms</td>
                      <td>
                        {{form.comp_1.total_rooms}}
                      </td>
                      <td>
                        {{form.comp_2.total_rooms}}
                      </td>
                      <td>
                        {{form.comp_3.total_rooms}}
                      </td>
                    </tr>
                    <tr>
                      <td>Square Feet</td>
                      <td>
                        {{form.comp_1.square_feet}}
                      </td>
                      <td>
                        {{form.comp_2.square_feet}}
                      </td>
                      <td>
                        {{form.comp_3.square_feet}}
                      </td>
                    </tr>
                    <tr>
                      <td>Bedrooms</td>
                      <td>
                        {{form.comp_1.bedrooms}}
                      </td>
                      <td>
                        {{form.comp_2.bedrooms}}
                      </td>
                      <td>
                        {{form.comp_3.bedrooms}}
                      </td>
                    </tr>
                    <tr>
                      <td>Bathrooms</td>
                      <td>
                        {{form.comp_1.bathrooms}}
                      </td>
                      <td>
                        {{form.comp_2.bathrooms}}
                      </td>
                      <td>
                        {{form.comp_3.bathrooms}}
                      </td>
                    </tr>
                    <tr>
                      <td>Lot Size</td>
                      <td>
                        {{form.comp_1.lot_size}}
                      </td>
                      <td>
                        {{form.comp_2.lot_size}}
                      </td>
                      <td>
                        {{form.comp_3.lot_size}}
                      </td>
                    </tr>
                    <tr>
                      <td>Basement</td>
                      <td>
                        {{form.comp_1.basement}}
                      </td>
                      <td>
                        {{form.comp_2.basement}}
                      </td>
                      <td>
                        {{form.comp_3.basement}}
                      </td>
                    </tr>
                    <tr>
                      <td>Condition</td>
                      <td>
                        {{form.comp_1.condition}}
                      </td>
                      <td>
                        {{form.comp_2.condition}}
                      </td>
                      <td>
                        {{form.comp_3.condition}}
                      </td>
                    </tr>
                    <tr>
                      <td>Comments</td>
                      <td>
                        {{form.comp_1.comments}}
                      </td>
                      <td>
                        {{form.comp_2.comments}}
                      </td>
                      <td>
                        {{form.comp_3.comments}}
                      </td>
                    </tr>
                    <tr>
                      <td>Sale Price</td>
                      <td>
                        {{form.comp_1.sale_price}}
                      </td>
                      <td>
                        {{form.comp_2.sale_price}}
                      </td>
                      <td>
                        {{form.comp_3.sale_price}}
                      </td>
                    </tr>
                    <tr>
                      <td>Sale Date</td>
                      <td>
                        {{form.comp_1.sale_date}}
                      </td>
                      <td>
                        {{form.comp_2.sale_date}}
                      </td>
                      <td>
                        {{form.comp_3.sale_date}}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-12 wrapper" v-else>
          	<h4>Decline Reason</h4>
          	<textarea class="form-control" v-model="form.reject_reason"></textarea>
          </div>
          <div v-if="!cancel" class="col-12 wrapper" style="margin-top:15px;">
            <h4>Overview</h4>
            <div class="insideInfo" style="margin-top:18px;">
              <div id="estimatedPrice">
                <div class="priceLabel">Estimated Market Value :</div>
                <div class="priceLabel">{{form.estimated_market_value}}</div>
              </div>
              <div class="pdfContainer" style="margin-top:20px;">
                <div class="leftLabel">Agent:</div>
                <div class="rightData">
                  <div class="answer">
                    <div class="agentName"></div>
                    <div class="licenseNumber"></div>
                  </div>
                  <div class="labels">
                    <div class="agentName">Agent Name</div>
                    <div class="licenseNumber">License Number</div>
                  </div>
                </div>
              </div>
              <div class="pdfContainer">
                <div class="leftLabel"></div>
                <div class="rightData">
                  <div class="answer">
                    <div class="signature"></div>
                  </div>
                  <div class="labels">
                    <div class="signature">Signature/Date</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12" style="float:left;margin-top:15px;">
            <div style="width:60%;text-align:center;font-size:10px;float:left;line-height:12px;padding-top:10px;">
              This document provides an estimated market value based upon data that the agent deems relevant. It does not provide an appraisal and takes no regard concerning any property's condition. All information has not been verified and is for the use of authorized users only.
            </div>
            <div style="width:40%;text-align:center;float:left;">
              <img style="height:80px;" src="./../../images/mpo_white_600_200.png" />
    				</div>
            </div>
          </div>
        </div>
      </div>
</template>
<script>
export default {
  name: "blank",
  props: ['form', 'cancel'],
  data: function() {
    return {
      // form: {
      //    turnaround: '',
      //    form_type: '',
      //    user_id: '',
      //    property_owner: '',
      //    property_address: '',
      //    county: '',
      //    parcel_id: '',
      //    city: '',
      //    state: 'MO',
      //    zip: '',
      //    zoning: 'Residential',
      //    bedrooms: '',
      //    bathrooms: '',
      //    square_feet: '',
      //    lot_size: '',
      //    basement: 'none',
      //    year_built: '',
      //    condition: 'Good',
      //    additional_comments: '',
      //    pricing: ''
      //  }
    }
  },
  mounted: function() {
    console.log(this.form)
  },
  destroyed: function() {

  }
}

</script>
<style lang="scss" scoped>
#mdaPdf {
  width: 8.5in;
  height: 11in;

  .wrapper {
    float: left;

    h4 {
      border-bottom: 1px solid black;
    }

    .insideInfo {
      .pdfContainer {
        height: 50px;
        width: 100%;

        .leftLabel {
          width: 20%;
          float: left;
          height: 100%;
          text-align: right;
          padding-right: 10px;
        }

        table {
          float: left;
          width: 100%;
          border-bottom: 1px solid #000;

          tr {

            td {
              border-top: 1px solid #000 !important;
              height: 30px;
              line-height: 30px;
              font-size: 18px;
              text-align: center !important;

              &:nth-child(1) {
                width: 15% !important;
                font-size: 11px;
                padding-left: 15px;
              }

              &:nth-child(3) {
                background-color: #efefef !important;
              }
            }

            th {
              &:nth-child(3) {
                background-color: #efefef !important;
              }
            }
          }
        }

        .rightData {
          width: 80%;
          height: 100%;
          float: left;

          .answer {
            width: 100%;
            /*border-bottom: 1px solid #000;*/
            height: 31px;
            font: 18px monospace;


            div {
              height: 100%;
              text-align: center;
              float: left;
            }

            /*&#commentsAnswer {
								border-bottom: 0px !important;
							}*/
          }

          .labels {
            width: 100%;
            height: 18px;
            border-top: 1px solid black;
            font-size: 10px;

            div {
              height: 100%;
              text-align: center;
              float: left;
            }

          }

          .street {
            width: 45%;
          }

          .city {
            width: 35%;
          }

          .state {
            width: 7%;
          }

          .zip {
            width: 13%;
          }

          .bedrooms {
            width: 25%;
          }

          .bathrooms {
            width: 25%;
          }

          .sq_ft {
            width: 25%;
          }

          .lot {
            width: 25%;
          }

          .year {
            width: 50%;
          }

          .basement {
            width: 50%;
          }

          .name {
            width: 50%;
          }

          .branch {
            width: 50%;
          }

          .customer_name {
            width: 50%;
          }

          .email {
            width: 50%;
          }

          .agentName {
            width: 50%;
          }

          .licenseNumber {
            width: 50%;
          }

          .signature {
            width: 100%;
          }
        }
      }

      #estimatedPrice {
        width: 70%;
        height: 60px;
        border: 2px solid #e0e0e0;
        margin-left: 15%;

        .priceLabel {
          width: 50%;
          float: left;
          text-align: center;
          height: 60px;
          line-height: 60px;
          font-size: 20px;
        }
      }
    }
  }
}

</style>
