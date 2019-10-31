import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// import layout
import BasicLayout from './views/layouts/BasicLayout.vue'

import User from './views/pages/User.vue'
import PostReview from './views/pages/PostReview.vue'
import Shop from './views/pages/Shop.vue'


const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [{
            path: '/admin',
            component: BasicLayout,
            children: [{
                path: 'user',
                component: User,
                name: 'user'
            }, {
                path: 'post-review',
                component: PostReview,
                name: 'postReview'
            }, {
                path: 'shop',
                component: Shop,
                name: 'shop'
            }]
        },
        {
            path: '*',
            // component: Demo
        }
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
