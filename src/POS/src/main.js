// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'

import { $, jQuery } from 'jquery';
// export for others scripts to use
window.$ = $;
window.jQuery = jQuery;

import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'font-awesome/css/font-awesome.min.css'
//import 'font-awesome/scss/font-awesome.scss'
import './assets/custom.css'


Vue.config.productionTip = false

/* eslint-disable no-new */
var vue = new Vue({
  el: '#app',
  components: { App },
  template: '<App/>'
})
