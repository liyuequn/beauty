let routes = [
    {
        path: '/login',
        component: require('./components/Login.vue'),
        name: '',
        hidden: true
    },
    {
        path: '/404',
        component: require('./components/404.vue'),
        name: '',
        hidden: true
    },
    {
        path: '/passport',
        component: require('./components/passport.vue'),
        name: '',
        hidden: true
    },
    {
        path: '/',
        component: require('./components/admin.vue'),
        name: '消息',
        hidden: false,
        children:[
            { path: '/message', name:'消息',component: require('./components/message/list.vue')},
        ]
    },
    {
        path: '/',
        name:'权限管理',
        component: require('./components/admin.vue'),
        hidden:false,
        children:[
            { path: '/users_list', name:'用户',component: require('./components/users/list.vue')},
            {path: '/index', component: require('./components/index.vue'), name: '', hidden: true},
        ]
    },{
        path: '/',
        name:'文章管理',
        component: require('./components/admin.vue'),
        hidden:false,
        children:[
            {path: '/articles', name:'文章', component: require('./components/articles/list.vue'),},
            { path: '/articles/write', name:'写文章', component: require('./components/articles/edit.vue'),hidden:true},
            { path: '/articles/:id', name:'查看', component: require('./components/articles/detail.vue'),hidden:true},
            { path: '/article/:id', name:'编辑', component: require('./components/articles/edit.vue'),hidden:true},
            {path: '/types', name:'文章类型', component: require('./components/type/list.vue')},
            {path: '/labels', name:'文章标签', component: require('./components/label/list.vue')},


        ]
    },
    {
        path:'/',
        name:'书籍管理',
        component:require('./components/admin.vue'),
        hidden:false,
        children:[
            {path: '/books', name:'书籍', component: require('./components/books/list.vue'),},
        ]
    }
]
export default routes;