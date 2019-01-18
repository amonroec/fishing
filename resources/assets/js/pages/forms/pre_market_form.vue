<template>
  <div id="pre_form_page">
    <card style="width:100%;" title="Choose Type">
      <div class="col-sm-12 col-md-4 col-lg-4 p-2 float-left" v-if="user && user.is_customer === 'yes'" style="text-align:center;">
        <div class="col-12 float-left">
          Comps Only
          <div v-if="user" class="col-12 float-left" style="color:red;">
            ${{user.pricing_comps_only}}
          </div>
          <div v-else class="col-12 float-left" style="color:red;">
            test
          </div>
        </div>
        <router-link to="/market_analysis_form/comps_only" class="btn btn-success">
          <!-- <fa icon="home" fixed-width/> -->
          Choose
        </router-link>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4 p-2 float-left" style="text-align:center;">
        <div class="col-12 float-left">
          Market Data Analysis
          <div v-if="user && user.is_customer === 'yes'" class="col-12 float-left" style="color:red;">
            ${{user.pricing_standard}}
          </div>
          <div v-else class="col-12 float-left" style="color:red;">
            $75.00
          </div>
        </div>
        <router-link to="/market_analysis_form/market_analysis" class="btn btn-success">
          <!-- <fa icon="home" fixed-width/> -->
          Choose
        </router-link>
      </div>
      <div v-if="user && user.is_customer === 'yes'" class="col-sm-12 col-md-4 col-lg-4 p-2 float-left" style="text-align:center;">
        <div class="col-12 float-left">
          Drive-By MPO
          <div v-if="user" class="col-12 float-left" style="color:red;">
            ${{user.pricing_drive_by_1}} - ${{user.pricing_drive_by_3}}
          </div>
          <div v-else class="col-12 float-left" style="color:red;">
            test
          </div>
        </div>
        <router-link to="/market_analysis_form/drive_by" class="btn btn-success">
          <!-- <fa icon="home" fixed-width/> -->
          Choose
        </router-link>
      </div>
    </card>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
  name: "blank",
  mounted: function() {
    console.log(this.user.is_customer)
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  destroyed: function() {

  }
}

</script>
