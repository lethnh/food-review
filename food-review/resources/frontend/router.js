import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// import layout
import BasicLayout from './views/layouts/BasicLayout.vue'


import TopPage from './views/pages/TopPage.vue'
// import Welcome from './views/Welcome'

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [{
        path: '/',
        component: BasicLayout,
        children: [{
            path: '/',
            component: TopPage,
            name: 'toppage'
        }]
    }, ],
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
