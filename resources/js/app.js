/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';
import VueCookie from 'vue-cookie';

//Route information for Vue Router
import router from '@/js/router/index';

import store from "@/js/store/store";

//Component file
import App from '@/js/views/App';

Vue.use(Vuetify);
Vue.use(VueCookie);

const app = new Vue({
    el: '#app',
    components: { App },
    template: '<App/>',
    vuetify: new Vuetify(),
    router,
    store
});

export default app;
