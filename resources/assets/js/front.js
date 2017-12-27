require('./bootstrap');
import Vue from 'vue'
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
Vue.component('ArticleEditor', require('./components/articles/edit.vue'));
Vue.component('login', require('./front/user/login.vue'));
Vue.component('comment', require('./front/article/comment.vue'));
Vue.component('comments', require('./front/article/comments.vue'));
Vue.use(Element,{ size: 'normal' })
const access_token = sessionStorage.getItem('access_token');
window.axios.defaults.headers.common['Authorization'] = 'Bearer '+access_token;

const app = new Vue({
    el: '#app'
})