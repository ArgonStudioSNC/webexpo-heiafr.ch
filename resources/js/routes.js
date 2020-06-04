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
            name: 'webxpo',
            redirect: {name: 'webxpo-2020'},
            component: Vue.component( 'webxpo', require( './pages/Webxpo.vue' ) ).default,
            children: [
                {
                    path: '2020/:degree?',
                    name: 'webxpo-2020',
                    component: Vue.component( 'webxpo2020', require( './pages/Webxpo2020.vue' ) ).default,
                },
            ],
        },
    ]
});
