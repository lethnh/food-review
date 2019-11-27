import Vue from 'vue'
import VueRouter from 'vue-router'
import AuthService from './js/services/Auth'
Vue.use(VueRouter)

// import layout
import BasicLayout from './views/layouts/BasicLayout.vue'

import User from './views/pages/User.vue'
import PostReview from './views/pages/PostReview.vue'
import Shop from './views/pages/Shop.vue'
import CreateShop from './views/pages/CreateShop.vue'
import CreateUser from './views/pages/CreateUser.vue'
import PostReviewDetail from './views/pages/PostReviewDetail.vue'
import ShopDetail from './views/pages/ShopDetail.vue'


const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [{
            path: '/admin',
            component: BasicLayout,
            meta: {
                requiresAuth: true,
            },
            children: [{
                    path: 'users',
                    component: User,
                    name: 'user'
                }, {
                    path: 'post-review',
                    component: PostReview,
                    name: 'postReview'
                }, {
                    path: 'shops',
                    component: Shop,
                    name: 'shop'
                },
                {
                    path: 'shop/create',
                    component: CreateShop,
                    name: 'createShop'
                },
                {
                    path: 'shop/:shop_id',
                    component: ShopDetail,
                    name: 'shopDetail'
                },
                {
                    path: 'post_review/:post_review_id',
                    component: PostReviewDetail,
                    name: 'postReviewDetail'
                },
                {
                    path: 'user/create',
                    component: CreateUser,
                    name: 'createUser'
                },
            ]
        },
        {
            path: '*',
            // component: Demo
        }
    ],
});

router.beforeEach((to, from, next) => {
    //  If the next route is requires user to be Logged IN
    if (to.matched.some(m => m.meta.requiresAuth)) {
        return AuthService.checkLogin().then(authenticated => {
            if (!authenticated) {
                return next({
                    path: '/login'
                })
            }
            return next()
        })
    }
    return next()
})

export default router
