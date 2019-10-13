import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// import layout
import BasicLayout from './views/layouts/BasicLayout.vue'


const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [{
            path: '/',
            component: BasicLayout,
            // children: [{
            //     // path: '/',
            //     // component: Home,
            //     // name: 'homepage'
            // }]
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
