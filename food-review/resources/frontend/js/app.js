/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import Vue from 'vue'

import router from '../router'
import store from './store';
import options from './config'
import VueQuillEditor from 'vue-quill-editor'
import StarRating from 'vue-star-rating'
import VueCurrencyFilter from 'vue-currency-filter'
import VueCurrencyInput from 'vue-currency-input'
// import TravelMap from "./components/TravelMap.vue";


import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import quillEmij from 'quill-emoji/dist/quill-emoji'
import 'quill-emoji/dist/quill-emoji.css'
import { NavbarPlugin } from 'bootstrap-vue'
Vue.use(NavbarPlugin)

Vue.use(VueQuillEditor, options)
Vue.use(VueCurrencyFilter, {
    symbol: 'VNĐ',
    thousandsSeparator: '.',
    fractionCount: 0,
    fractionSeparator: ',',
    symbolPosition: 'front',
    symbolSpacing: true
})
const pluginOptions = {
    /* see config reference */ }
Vue.use(VueCurrencyInput, pluginOptions)
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('example-component', require('./components/province-select.vue').default);

Vue.component('star-rating', StarRating);

// Vue.component('travel-map', TravelMap);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router,
});
