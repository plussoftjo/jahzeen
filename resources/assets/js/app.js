
require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
window.Vue.use(Vuetify);
window.Vue.use(VueRouter);
import { routes } from './routes.js';
import 'vuetify/dist/vuetify.min.css';
window.mapboxgl = require('mapbox-gl');
 
mapboxgl.accessToken = 'pk.eyJ1IjoiYWhtYWRhbHRvbW15IiwiYSI6ImNqbmtlODc4azAwdHEzeXA2MjBjNml2dmoifQ.XOiKqWntxy0QOkL9eddzZw';

const router = new VueRouter({
  routes,
  scrollBehavior (proudect, home, savedPosition) {
  return { x: 0, y: 0 }
}
});

import main from './components/main.vue';

const app = new Vue({
    el: '#app',
    router,
    render: h => h(main)
});
