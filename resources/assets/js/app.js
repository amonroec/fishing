import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'

import axios from 'axios'
import VueAxios from 'vue-axios'
import { StripeCheckout } from 'vue-stripe'
Vue.component('stripe-checkout', StripeCheckout);

Vue.use(VueAxios, axios)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
