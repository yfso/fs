// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import axios from 'axios'
import iView from 'iview'
import 'iview/dist/styles/iview.css'
import router from './router'

Vue.config.productionTip = false
Vue.use(iView,{transfer:true})

axios.defaults.baseURL = 'http://api.fs.com';
// axios.defaults.headers.common['Authorization'] = AUTH_TOKEN;
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

router.beforeEach((to, from, next) => {
	if(to.path!='/login'){
		if((sessionStorage.getItem('yftoken')==null)||(sessionStorage.getItem('yftoken')=='')){
			router.replace('/login');
		}else{
			next()
		}
	}else{
		next()
	}
})

new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
