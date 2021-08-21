require('./bootstrap');
window.Vue = require('vue').default;
//Import 
import createPersistedState from 'vuex-persistedstate'
import moment from 'moment'
import Vuex from 'vuex'
import Vue2Filters from 'vue2-filters'
import Vue from 'vue'
import {
    BootstrapVue,
    IconsPlugin
} from 'bootstrap-vue'
import InstantSearch from 'vue-instantsearch';
// Import Bootstrap an BootstrapVue CSS files (order is important)
//import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.config.productionTip = false;

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
    // Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(Vue2Filters)
Vue.use(Vuex)
Vue.use(InstantSearch);

//Vuex store local storage
const store = new Vuex.Store({
        state: {
            cart: [],
        },
        plugins: [createPersistedState()],

        mutations: {
            addToCart(state, product) {
                let productInCartIndex = state.cart.findIndex(item => item.book_id === product.book_id);
                if (productInCartIndex !== -1) {
                    state.cart[productInCartIndex].quantity++;
                    return;
                }
                product.quantity = 1;
                state.cart.push(product);
            },
            addToCartMulti(state, {
                product,
                total
            }) {
                let productInCartIndex = state.cart.findIndex(item => item.book_id === product.book_id);
                let quantity = parseInt(total);
                if (productInCartIndex !== -1) {
                    state.cart[productInCartIndex].quantity += quantity;
                    return;
                }
                product.quantity = quantity;
                state.cart.push(product);
            },
            removeFromCart(state, index) {
                state.cart.splice(index, 1);
            },
            updateCart(state, cart) {
                state.cart = cart;
            }
        },
        actions: {
            clearCart({
                commit
            }) {
                commit('updateCart', []);
            }
        }
    })
    //Register component 
Vue.component('shopping-cart', require('./components/client/shopping_cart/cart').default);
Vue.component('add-cart', require('./components/client/vendor/add-cart').default);
Vue.component('my-cart', require('./components/client/shopping_cart/cart_detail').default);
Vue.component('checkout', require('./components/client/shopping_cart/checkout').default);
Vue.component('login-form', require('./components/client/account/form/login').default);
Vue.component('register-form', require('./components/client/account/form/register').default);
Vue.component('logout', require('./components/client/vendor/logout').default);
Vue.component('shop-algolia', require('./components/client/shop/shop').default);
Vue.component('product-detail', require('./components/client/shop/product-detail').default);
Vue.component('notifications', require('./components/client/account/my-account/notifications').default);
Vue.component('notification-list', require('./components/client/account/my-account/notifications-list').default);
Vue.component('my-order', require('./components/client/account/my-account/my-order').default);
Vue.component('address-billing', require('./components/client/account/my-account/address-billing').default);
Vue.component('my-information', require('./components/client/account/my-account/my-information').default);
Vue.component('order-check', require('./components/client/order/order-check.vue').default);
Vue.component('favorite', require('./components/client/account/my-account/favorite.vue').default);
Vue.component('search-panel', require('./components/client/shop/search').default);
Vue.component('contact', require('./components/client/home/contact').default);
Vue.component('related', require('./components/client/product/product_relation').default);
Vue.component('add-to-cart', require('./components/client/vendor/add-cart-home.vue').default);
const app = new Vue({
    store,
    el: '#app',
    methods: {
        makeToast(variant, mess) {
            this.$bvToast.toast(mess, {
                title: "Messege feeback :",
                variant: variant,
                solid: true,
            });
        },
        datetime(date) {
            return moment(date).format("DD/MM/YYYY");
        },
        timeago(date) {
            return moment(date).startOf("hours").fromNow();
        },
    },
});