import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import VueTheMask from 'vue-the-mask'
import Notifications from 'vue-notification'

Vue.config.productionTip = false
Vue.use(VueTheMask);
Vue.use(Notifications);

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
