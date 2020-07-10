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
            path: '',
            name: 'webexpo',
            redirect: {name: 'webexpo-2020'},
            component: Vue.component( 'webexpo', require( './pages/Webexpo.vue' ) ).default,
            children: [
                {
                    path: '2020/',
                    name: 'webexpo-2020',
                    redirect: '2020/bachelor',
                },
                {
                    path: '2020/:degree?',
                    component: Vue.component( 'webexpo2020', require( './pages/Webexpo2020.vue' ) ).default,
                },
            ],
        },
    ]
});
