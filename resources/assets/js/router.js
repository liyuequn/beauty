let routes = [
    {
        path: '/',
        name:'users',
        component: require('./components/admin.vue'),
        hidden:true,
        children:[
            { path: '/foo', name:'roles',component: require('./components/Example.vue')}
        ]
    },
    {
        path: '/ex',
        name:'articles',
        component: require('./components/Example.vue'),
        hidden:true,
    },
]
export default routes;