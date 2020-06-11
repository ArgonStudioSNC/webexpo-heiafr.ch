window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');

    require('foundation-sites');
} catch (e) {}

$(function(){
    $(document).foundation();
    $('body').css('display', 'block');
});

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue'
import router from './routes.js'
import store from './store.js'
import i18n from './i18n.js'

import vueSmoothScroll from 'vue2-smooth-scroll'
Vue.use(vueSmoothScroll)

import { library } from '@fortawesome/fontawesome-svg-core'
import { faFilePdf } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(faFilePdf)
Vue.component('font-awesome-icon', FontAwesomeIcon)

new Vue({
    router,
    store,
    i18n
}).$mount('#app')
