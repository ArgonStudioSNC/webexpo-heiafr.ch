import jQuery from 'jquery'
window.$ = window.jQuery = jQuery

import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import '@sass/app.scss';

import { createApp } from 'vue';
import App from "./App.vue";

import router from './router'
import store from './store'
import i18n from './i18n'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faFilePdf } from '@fortawesome/free-regular-svg-icons'
library.add(faFilePdf)

import { YouTube } from 'vue3-youtube'
import { Interchange, Sticky, SmoothScroll, Reveal } from 'foundation-sites';

const app = createApp(App);

app.use(router);
app.use(store);
app.use(i18n);

app.directive('foundation', {
    mounted: (el, binding) => $(el).foundation(),
    beforeUnmount: (el, binding) => $(el).foundation('_destroy'),
});

app.component('font-awesome-icon', FontAwesomeIcon);
app.component('YouTube', YouTube);
app.component(Interchange, Sticky, SmoothScroll, Reveal);

app.mount('#app');
