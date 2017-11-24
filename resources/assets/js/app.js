require('./bootstrap');
import Vue from 'vue'
//include elementui
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
//include vue-router
import VueRouter from 'vue-router'
import routes from './router'
//lang
import locale from 'element-ui/lib/locale/lang/en'
//style
import '../sass/element-variables.scss'
Vue.use(VueRouter)
Vue.use(Element, { locale },{ size: 'small' })
// console.log(routes)
// 3. 创建 router 实例，然后传 `routes` 配置
const router = new VueRouter({
    routes // （缩写）相当于 routes: routes
})

// 4. 创建和挂载根实例。
// 记得要通过 router 配置参数注入路由，
// 从而让整个应用都有路由功能
const app = new Vue({
    router
}).$mount('#app')

