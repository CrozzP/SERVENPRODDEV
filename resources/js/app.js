

require('./bootstrap');

//alert('Hello World');


import Vue from 'vue';

//window.Vue = require('vue');

import router from './router';
import common from './common';

import * as VueGoogleMaps from 'vue2-google-maps';
//Vue.config.productionTip = false

Vue.mixin(common)

import { Camera, Microphone } from 'vue-capture';

import store from './store';

//import BootstrapVue from 'bootstrap-vue';
//Vue.use(BootstrapVue);

/////////////////////////////////////////////
//import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
////////////////////////////////////////////


Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyAO0dxLFituDGnhv3emX0MKmmbLT3THuLc',
    //libraries: 'places',
    
  }
});


import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

//import {Bar} from 'vue-chartjs';
//import {Line, mixins} from 'vue-chartjs';

import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js/auto'


import pdf from 'vue-pdf';
ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)


//import { IconsPlugin } from 'bootstrap-vue'
//Vue.use(IconsPlugin)

Vue.use(pdf);
Vue.use(VueSweetalert2);
//Vue.use(require('vue-resource'));
//Vue.component('pagination', require('laravel-vue-pagination'));

//TIMEAGO



//import 'vue2-timeago/dist/vue2-timeago.css';

//77OTRO



import 'advanced-laravel-vue-paginate/dist/advanced-laravel-vue-paginate.css'
Vue.use(require('advanced-laravel-vue-paginate'));

Vue.component('app-template', require('./App.vue').default);

//service
Vue.component('appservice-template', require('./AppService.vue').default);

Vue.component('appr-template', require('./Appr.vue').default);

Vue.component('apprer-template', require('./AppRer.vue').default);
Vue.component('appfront-template', require('./AppFront.vue').default);
Vue.component('app-repositorio-template', require('./AppRepositorio.vue').default);

//File

//import FileBox from './components/File'
//import FolderFormBox from './components/FolderForm'
//import FileFormBox from './components/FileForm'

//window.feather = require('feather-icons');

//import { feather } from 'feather-icons/dist/feather.js';
//Vue.use(feather);
//const feather = require('feather-icons/dist/feather.js');
//feather.replace();

//import 'feather-icons/dist/feather.js'







 /////////////////
//const { reactiveProp } = mixins;

const app = new Vue({
    el: '#app',
 router,
 pdf,
 store,
 ChartJS,
 //feather,

 

});
