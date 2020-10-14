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
Vue.component('projetos-component', require('./components/Projetos/ProjetosComponent.vue').default);
Vue.component('tv-amic-component', require('./components/TvAmic/ListaComponent.vue').default);
Vue.component('projeto-edicoes-component', require('./components/Projetos/ProjetoEdicoesComponent.vue').default);
Vue.component('edicoes-component', require('./components/Projetos/EdicoesComponent.vue').default);
Vue.component('foto-component', require('./components/Global/FotoComponent.vue').default);
Vue.component('foto-multiple-component', require('./components/Global/FotoMultipleComponent.vue').default);

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import FlashMessage from '@smartweb/vue-flash-message';
import Vuetify from 'vuetify';
import DatetimePicker from 'vuetify-datetime-picker';
import VueCropper from 'vue-cropperjs';
import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import "@mdi/font/scss/materialdesignicons.scss";
import CKEditor from '@ckeditor/ckeditor5-vue';
import '@ckeditor/ckeditor5-build-classic/build/translations/pt';
import pt from 'vuetify/es5/locale/pt';
// import 'cropperjs/dist/cropper.css';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(FlashMessage);
Vue.use(Vuetify);
Vue.use(DatetimePicker);
Vue.use( CKEditor );
Vue.component(VueCropper);

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
        lang: {
          locales: { pt },
          current: 'pt',
        },
    }),
});
