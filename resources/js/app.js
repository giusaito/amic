/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-resource'));
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.component('projetos-component', require('./components/Projetos/ListaComponent.vue').default);

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import FlashMessage from '@smartweb/vue-flash-message';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(FlashMessage);
Vue.use(Vuetify);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        theme: {
          themes: {
            light: {
              primary: '#676a6c',
              secondary: '#b0bec5',
              accent: '#8c9eff',
              error: '#b71c1c',
            },
          },
        },
    }),
});
