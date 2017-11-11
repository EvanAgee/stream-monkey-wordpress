import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'

Vue.config.devtools = true
Vue.use(Vuex)

// Modules
import StreamMonkey from './modules/StreamMonkey'

const vuexLocal = new VuexPersistence({
  key: 'stream-monkey-wordpress',
  storage: window.localStorage,
  // reducer: state => ({ StreamMonkey: state.recentMessages })
})

export default new Vuex.Store({
  modules: {
    StreamMonkey
  },
  plugins: [vuexLocal.plugin]
})
