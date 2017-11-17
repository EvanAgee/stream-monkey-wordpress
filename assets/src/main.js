import Vue from 'vue'
import Axios from 'axios'
import VueTruncate from 'vue-truncate-filter'
import lodash from 'lodash'
import moment from 'moment'

Vue.use(VueTruncate)

import App from './App.vue'
import store from './store'
import router from './router'

window._ = lodash
window.axios = Axios
window.streamMonkeySettings = streamMonkeySettings // variable is created in the DOM

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMMM Do YYYY')
  }
})

Vue.config.devtools = true
new Vue({
  el: '#streamMonkeyWordpress',
  store,
  router,
  render: h => h(App)
})