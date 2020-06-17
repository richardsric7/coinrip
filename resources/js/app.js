/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import store from './appstore';

require('./bootstrap');
require('admin-lte');

window.Vue = require('vue');
import Vuex from 'vuex';
Vue.use(Vuex);
import moment from 'moment';

//event bus
window.EventBus = new Vue()
import Vue2Filters from 'vue2-filters'

Vue.use(Vue2Filters)
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

import VModal from 'vue-js-modal'

Vue.use(VModal)

import {
    Form,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
  } from 'vform'

  Vue.component(HasError.name, HasError)
  Vue.component(AlertError.name, AlertError)
  Vue.component(AlertErrors.name, AlertErrors)
  Vue.component(AlertSuccess.name, AlertSuccess)

  window.Form = Form


  import Swal from 'sweetalert2'
  window.Swal = Swal

import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'

Vue.use(Chartkick.use(Chart))

import VueRouter from 'vue-router'
Vue.use(VueRouter);
import routes from './router'

const router = new VueRouter({
    // mode: 'history',
    routes,
    linkActiveClass: "active",
})
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.getIsAuthenticated) {
            next('/login')
        } else {
            next()
        }
    } else {
        next()
    }

})

window.Router = router;




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('main-nav-component', require('./components/shared/MainNavComponent').default);
Vue.component('convert-currency-component', require('./components/CurrencyConvert').default);
Vue.component('line-chart-component', require('./components/LineChartComponent').default);
Vue.component('pie-chart-component', require('./components/PieChartComponent').default);
Vue.component('pagination', require('laravel-vue-pagination')).default;



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



