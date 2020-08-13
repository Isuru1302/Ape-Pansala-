import '@babel/polyfill'
import 'mutationobserver-shim'
import Vue from 'vue'
import './plugins/bootstrap-vue'
import './plugins/bootstrap-vue'
import App from './App'
import router from './router'
import vueResource from 'vue-resource'
import * as veeValidate from 'vee-validate'
import VueSession from 'vue-session'
import CKEditor from '@ckeditor/ckeditor5-vue'
import VueCookies from 'vue-cookies'

Vue.config.productionTip = false



Vue.use(veeValidate)
Vue.use(vueResource)
Vue.use(VueSession)
Vue.use(CKEditor)
Vue.use(VueCookies)

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
