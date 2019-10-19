import Vue from 'vue'
import VueRouter from 'vue-router'
import AuthService from './js/services/Auth'

Vue.use(VueRouter)

// import layout
import BasicLayout from './views/layouts/BasicLayout.vue'
import BasicLayout2 from './views/layouts/BasicLayout2.vue'
import BasicLayout3 from './views/layouts/BasicLayout3.vue'

// import page
import TopPage from './views/pages/TopPage.vue'
import TimeLine from './views/pages/TimeLine.vue'
import Login from './views/pages/auth/Login.vue'
import Register from './views/pages/auth/Register.vue'
import ForgotPassword from './views/pages/auth/ForgotPassword.vue'
import Profile from './views/pages/reviewer/Profile.vue'
import CreatePostReview from './views/pages/reviewer/CreatePostReview.vue'
import PostReviewDetail from './views/pages/PostReviewDetail.vue'
import NotFound from './views/pages/errors/NotFound.vue'

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [{
            path: '/',
            component: BasicLayout,
            children: [{
                path: 'toppage',
                component: TopPage,
                name: 'toppage'
            }, {
                path: 'timeline',
                component: TimeLine,
                name: 'timeline'
            }]
        },
        {
            path: '/',
            component: BasicLayout2,
            children: [{
                    path: 'login',
                    component: Login,
                    name: 'login'
                },
                {
                    path: 'register',
                    component: Register,
                    name: 'register'
                },
            ]
        },
        {
            path: '/',
            component: BasicLayout3,
            children: [{
                    path: 'profile',
                    component: Profile,
                    name: 'profile'
                },
                {
                    path: 'review',
                    component: CreatePostReview,
                    name: 'createPostReview'
                },
                {
                    path: 'post-review/:post_id',
                    component: PostReviewDetail,
                    name: 'postReviewDetail'
                },
            ]
        }, //  DEFAULT ROUTE
        {
            path: '*',
            component: NotFound
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
