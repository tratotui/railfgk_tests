/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

import Vue from 'vue';
import Vuetify from 'vuetify';
import store from './store/index';

import Application from './components/Application.vue';

Vue.use(Vuetify);
Vue.component('application', Application);

new Vue({
  el: '#app',
  store
});



// let Vue = require('vue'),
// 	Vuetify = require('vuetify');

// Vue.use(Vuetify);

// window.Vue = Vue;

// *
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
 

// Vue.component('application', require('./components/Application.vue'));

// const app = new Vue({
//     el: '#app',
//     store: require('./store/index')
// });
