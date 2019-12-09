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
import VueCurrencyFilter from 'vue-currency-filter'
import VueCurrencyInput from 'vue-currency-input'
// import TravelMap from "./components/TravelMap.vue";
import TimePicker from "ant-design-vue/lib/time-picker";
import Icon from 'ant-design-vue/lib/icon';
import Rate from "ant-design-vue/lib/rate";
import Select from 'ant-design-vue/lib/select';
import Carousel from 'ant-design-vue/lib/carousel';
import Slider from 'ant-design-vue/lib/slider';
import VueLoading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
import Pagination from 'ant-design-vue/lib/pagination';
import "ant-design-vue/lib/pagination/style/css";

import "ant-design-vue/lib/carousel/style/css";
import "ant-design-vue/lib/slider/style/css";
import "ant-design-vue/lib/select/style/css";
import "ant-design-vue/lib/time-picker/style/css";
import "ant-design-vue/lib/rate/style/css";


import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import quillEmij from 'quill-emoji/dist/quill-emoji'
import 'quill-emoji/dist/quill-emoji.css'
import {
    FormRadioPlugin
} from 'bootstrap-vue'
Vue.use(FormRadioPlugin)


Vue.use(VueQuillEditor, options)
$('[data-toggle="tooltip"]').tooltip();
Vue.use(VueCurrencyFilter, {
    symbol: 'VNĐ',
    thousandsSeparator: '.',
    fractionCount: 0,
    fractionSeparator: ',',
    symbolPosition: 'front',
    symbolSpacing: true
})



Vue.component('loading', VueLoading);

import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDC4X1rsM5q_r53_iL9hqFC3ctzsQD7HEc',
        libraries: 'places', // This is required if you use the Autocomplete plugin
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)

        //// If you want to set the version, you can do so:
        // v: '3.26',
    },

    //// If you intend to programmatically custom event listener code
    //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
    //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
    //// you might need to turn this on.
    // autobindAllEvents: false,

    //// If you want to manually install components, e.g.
    //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
    //// Vue.component('GmapMarker', GmapMarker)
    //// then disable the following:
    // installComponents: true,
})
Vue.use(VueCurrencyInput)
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

Vue.component('TimePicker', TimePicker);
Vue.component('Rate', Rate);
Vue.use(Select);
Vue.use(Carousel);
Vue.use(Pagination);
Vue.use(Icon);
Vue.use(Slider);

/**
 * Add global router function
 */
global.route = function (name, params = {}, query = {}) {
    return router.resolve({
        name: name,
        params: params,
        query: query,
    })
}
Vue.prototype.route = global.route;

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
