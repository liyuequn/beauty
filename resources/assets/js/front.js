require('./bootstrap');
import Vue from 'vue'
import 'element-ui/lib/theme-chalk/index.css'
import {
    Input,
    Button,
    Form,
    FormItem,
    Row,
    Col,
    Loading,
    Message,
    DatePicker,
    Select,
    Option,
} from 'element-ui'

Vue.use(Input)
Vue.use(Button)
Vue.use(Form)
Vue.use(FormItem)
Vue.use(Row)
Vue.use(Col)
Vue.use(DatePicker)
Vue.use(Select)
Vue.use(Option)
Vue.use(Loading.directive)

Vue.prototype.$loading = Loading.service
Vue.prototype.$message = Message
Vue.component('ArticleEditor', require('./components/articles/edit.vue'));
Vue.component('login', require('./front/user/login.vue'));
Vue.component('register', require('./front/user/register.vue'));
Vue.component('comment', require('./front/article/comment.vue'));
Vue.component('apend', require('./front/article/apend.vue'));
Vue.component('BeArticle', require('./front/user/article.vue'));
Vue.component('comments', require('./front/article/comments.vue'));
const access_token = sessionStorage.getItem('access_token');
if(!access_token){
    //在不同页面的时候，自动登录,判断依据用session
}
window.axios.defaults.headers.common['Authorization'] = 'Bearer '+access_token;

const app = new Vue({
    el: '#app'
})