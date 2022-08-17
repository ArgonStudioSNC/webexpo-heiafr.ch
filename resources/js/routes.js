/*
|-------------------------------------------------------------------------------
| routes.js
|-------------------------------------------------------------------------------
| Contains all of the routes for the application
*/

/*
    Imports Vue and VueRouter to extend with the routes.
*/
import Vue from 'vue'
import VueRouter from 'vue-router'

/*
    Extends Vue to use Vue Router
*/
Vue.use( VueRouter )

/*
    Makes a new VueRouter that we will use to run all of the routes
    for the app.
*/
export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '2022/bachelor',
        },
        {
            path: '/:edition',
            redirect: ':edition/bachelor',
        },
        {
            path: '/2020/:degree',
            component: Vue.component( 'webexpo2020', require( './pages/Webexpo2020.vue' ) ).default,
        },
        {
            path: '/2021/:degree',
            component: Vue.component( 'webexpo2021', require( './pages/Webexpo2021.vue' ) ).default,
        },
        {
            path: '/2022/:degree',
            component: Vue.component( 'webexpo2022', require( './pages/Webexpo2022.vue' ) ).default,
        },
        {
            path: '/preview/:degree',
            name: 'preview',
            component: Vue.component( 'webexpo2022', require( './pages/Webexpo2022.vue' ) ).default,
        },
        {
            path: '*',
            component: Vue.component( 'not-found', require( './pages/404.vue' ) ).default,
        },
    ]
});
