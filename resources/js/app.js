/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';

import VueRouter from 'vue-router';

Vue.config.productionTip = false;

Vue.use(VueRouter);

import App from './components/App.vue';
import Companies from './components/Companies.vue';
import Employees from './components/Employees.vue';

const routes = [
    { path: '/employees', component: Employees },
    { path: '/:page?', component: Companies },
]

const router = new VueRouter({
    routes
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('companies', require('./components/Companies.vue').default);

// Vue.component('company-info', require('./components/CompanyInfo.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    render: h => h(App)
}).$mount('#app');
