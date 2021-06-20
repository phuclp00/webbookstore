/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
import ElementUI from 'element-ui'
import locale from "element-ui/lib/locale/lang/en"
import "element-ui/lib/theme-chalk/index.css"
import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'
import modal from "vue-js-modal"
import Vue2Filters from 'vue2-filters'
Vue.use(Vue2Filters)
    //import css files
    // import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// Install BootstrapVue
Vue.use(BootstrapVue)
    // Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(ElementUI, {
    locale
});
Vue.use(modal, {
    dynamicDefault: {
        draggable: true,
        resizable: true
    }
})

import 'jszip'
import pdfMake from 'pdfmake'
import pdfFonts from 'pdfmake/build/vfs_fonts'
//Setting PDF Export 
pdfMake.vfs = pdfFonts.pdfMake.vfs;
Vue.use(pdfMake);
import 'datatables.net-bs4'
import 'datatables.net-buttons-bs4'
import 'datatables.net-buttons/js/buttons.colVis.js'
import 'datatables.net-buttons/js/buttons.html5.js'
import 'datatables.net-buttons/js/buttons.print.js'
import Vue from 'vue';
// Vue.use(ElementUI, {
//     size: Cookies.get('size') || 'medium', // set element-ui default size
//     locale: enLang // 如果使用中文，无需设置，请删除
// });

Vue.component('input-tags', require('./components/admin/vendor/tags.vue').default);
Vue.component('thumbnail-list', require('./components/admin/vendor/thumbnail.vue').default);


Vue.component('notification-user', require('./components/admin/user/notification/UserTracker.vue').default);
Vue.component('alert-success', require('./components/admin/alert/Success.vue').default);
Vue.component('alert-warning', require('./components/admin/alert/Warning.vue').default);
Vue.component('alert-danger', require('./components/admin/alert/Danger.vue').default);
Vue.component('alert-info', require('./components/admin/alert/Info.vue').default);
Vue.component('datatable-userlist', require('./components/admin/user/UserDataTable.vue').default);
Vue.component('booklist-selling', require('./components/admin/book/booklist.vue').default);
Vue.component('booklist-out-of-business', require('./components/admin/book/booklist_out_of_business.vue').default);
Vue.component('publisher', require('./components/admin/publisher/publisher.vue').default);
Vue.component('supplier', require('./components/admin/supplier/supplier.vue').default);
Vue.component('category', require('./components/admin/category/category.vue').default);
Vue.component('tags', require('./components/admin/tags/tags.vue').default);
Vue.component('author', require('./components/admin/author/author.vue').default);
Vue.component('series', require('./components/admin/series/series.vue').default);
Vue.component('format', require('./components/admin/format/format.vue').default);
Vue.component('translator', require('./components/admin/translator/translator.vue').default);


//Vendor
Vue.component('date-picker', require('./components/admin/vendor/datepicker.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
});