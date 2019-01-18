<template>
    <div id="previewOrder">
    	<div v-if="data" class="card bg-info-card">
    		<div class="card-body">
    			<h4 class="card-title">Order #{{data.id}}</h4>
	    		<div v-for="(value,index) in data.form_orders" class="card" style="width: 100%;">
					  <div class="card-body" @click="">
					    <h5 class="card-title">Form {{value.id}}</h5>
					    <p class="card-text">{{value.form_type.replace(/_/g,' ').replace(/'/g,'')}} - {{value.property_owner}} - {{value.zoning}}
					    	<a data-toggle="collapse" :href="'#order' + index" role="button" aria-expanded="false" :aria-controls="'order' + index">Click for more details</a>
					    	<a class="float-right"><i class="fa fa-trash"></i>Status: {{value.status}}</a>
					    </p>
					    
					    <div class="collapse multi-collapse" :id="'order' + index">
					      <div class="card card-body">
					      	<market-analysis-form :disabled="true" :data="value" :type="value.form_type"></market-analysis-form>
					      </div>
					    </div>
					  </div>
					</div>
				</div>
	    </div>
    </div>
</template>
<script>
import axios from 'axios'
import MarketAnalysisForm from './market_analysis_form'
var methods = {}

methods.getOrder = function () {
	const postData = {
		id: this.id
	}
	axios.post('/api/getOrder', postData).then(response => {
		if (response.status === 200) {
			console.log(response)
			this.data = response.data
		}
	})
}

export default {
    name: "OrderPreview",
    middleware: 'auth',
    props: ['id'],
    data: function () {
    	return {
    		data: null
    	}
    },
    components: {
    	MarketAnalysisForm
    },
    mounted: function() {
    	this.getOrder()
    },
    methods: methods,
    destroyed: function() {

    }
}
</script>
