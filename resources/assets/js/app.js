require('./bootstrap');
import Vue from 'vue'
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import VueRouter from 'vue-router'
import routes from './router'
// import locale from 'element-ui/lib/locale/lang/en' { locale }
import '../sass/element-variables.scss'
Vue.use(VueRouter)
Vue.use(Element,{ size: 'normal' })
const router = new VueRouter({
    routes
})
router.beforeEach((to, from, next) => {

    const access_token = sessionStorage.getItem('access_token');
    if (to.path == '/login') {
        sessionStorage.removeItem('access_token');
    }
    if( !access_token && to.path != '/login' ) {
        next('/login');
     } else{
         next();
     }

})
const app = new Vue({
    router
}).$mount('#app')

