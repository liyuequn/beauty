require('./bootstrap');
import Vue from 'vue'
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import VueRouter from 'vue-router'
import routes from './router'
import locale from 'element-ui/lib/locale/lang/en'
import '../sass/element-variables.scss'
Vue.use(VueRouter)
Vue.use(Element, { locale },{ size: 'small' })
const router = new VueRouter({
    routes
})
router.beforeEach((to, from, next) => {
    // ...
    next();
})
const app = new Vue({
    router
}).$mount('#app')

