import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// import layout
import BasicLayout from './views/layouts/BasicLayout.vue'
import BasicLayout2 from './views/layouts/BasicLayout2.vue'

// import page
import Home from './views/pages/Home.vue'
import Login from './views/pages/Login.vue'
import Register from './views/pages/Register.vue'


const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [{
            path: '/',
            component: BasicLayout,
            children: [{
                path: '/',
                component: Home,
                name: 'homepage'
            }]
        },
        {
            path: '/',
            component: BasicLayout2,
            children: [{
                    path: '/login',
                    component: Login,
                    name: 'login'
                },
                {
                    path: '/register',
                    component: Register,
                    name: 'register'
                },
            ]
        },
    ],
});

// router.beforeEach((to, from, next) => {
//     //  If the next route is requires user to be Logged IN
//     if (to.matched.some(m => m.meta.requiresAuth)) {
//         return AuthService.checkLogin().then(authenticated => {
//             if (!authenticated) {
//                 return next({
//                     path: '/login'
//                 })
//             }
//             return next()
//         })
//     }
//     return next()
// })

export default router
