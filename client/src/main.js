import Vue from 'vue'
import App from './App.vue'
import VueX from 'vuex'
import Echo from 'laravel-echo'
import store from './store'
import router from './router'
Vue.config.productionTip = false

Vue.use(VueX)

window.Pusher = require('pusher-js')

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.VUE_APP_WEBSOCKETS_APP_KEY,
  wsHost: process.env.VUE_APP_WEBSOCKETS_SERVER,
  wsPort: 6001,
  forceTLS: false,
  disableStats: true
})

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
