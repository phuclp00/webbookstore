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
import ElementUI from 'element-ui';
import locale from "element-ui/lib/locale/lang/en";
import "element-ui/lib/theme-chalk/index.css";
Vue.use(ElementUI, { locale });

Vue.config.productionTip = false;

// Vue.use(ElementUI, {
//     size: Cookies.get('size') || 'medium', // set element-ui default size
//     locale: enLang // 如果使用中文，无需设置，请删除
// });


Vue.component('notification-user', require('./components/user/notification/UserTracker.vue').default);
Vue.component('alert-success', require('./components/alert/Success.vue').default);
Vue.component('alert-warning', require('./components/alert/Warning.vue').default);
Vue.component('alert-danger', require('./components/alert/Danger.vue').default);
Vue.component('alert-info', require('./components/alert/Info.vue').default);
Vue.component('datatable-userlist', require('./components/user/UserDataTable.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
});