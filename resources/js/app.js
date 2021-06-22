/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

//import store from './ProductStore'
import router from './CategoryRouter.js'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('addtocart-component', require('./components/addToCartComponent.vue').default);
Vue.component('cart-component', require('./components/cartComponent.vue').default);
Vue.component('categorylink-component', require('./components/categoryLinkComponent.vue').default);
Vue.component('category-component', require('./components/categoryComponent.vue').default);
Vue.component('checkout-component', require('./components/checkoutComponent.vue').default);
Vue.component('comment-component', require('./components/commentComponent.vue').default);
Vue.component('createprofile-component', require('./components/productsComponent.vue').default);
Vue.component('deleteproduct-component', require('./components/deleteProductComponent.vue').default);
Vue.component('editprofile-component', require('./components/productsComponent.vue').default);
Vue.component('navigation-component', require('./components/navigationComponent.vue').default);
Vue.component('notifications-component', require('./components/notificationsComponent.vue').default);
Vue.component('order-component', require('./components/orderComponent.vue').default);
Vue.component('orders-component', require('./components/ordersComponent.vue').default);
Vue.component('products-component', require('./components/productsComponent.vue').default);
Vue.component('report-component', require('./components/reportComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    //store:store,
    router:router
});
