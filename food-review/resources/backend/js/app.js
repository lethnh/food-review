/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
require('./bootstrap');
import router from '../router'
import {
    TableComponent,
    TableColumn
} from 'vue-table-component'
window.Vue = require('vue');
import VueSidebarMenu from 'vue-sidebar-menu'
import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'


Vue.component('table-component', TableComponent);
Vue.component('table-column', TableColumn);

Vue.use(VueSidebarMenu)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
global.route = function (name, params = {}, query = {}) {
    return router.resolve({
        name: name,
        params: params,
        query: query,
    })
}
Vue.prototype.route = global.route;
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app2',
    router,
});
