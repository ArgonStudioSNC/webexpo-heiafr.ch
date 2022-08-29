/*
|-------------------------------------------------------------------------------
| router/index.js
|-------------------------------------------------------------------------------
| Contains all of the routes for the application
*/

import { createRouter, createWebHistory } from 'vue-router'

import Webexpo2020 from '@/pages/webexpo2020.vue'
import Webexpo2021 from '@/pages/webexpo2021.vue'
import Webexpo2022 from '@/pages/webexpo2022.vue'
import NotFound from '@/pages/404.vue'

const routes = [
    {
        path: '/',
        redirect: { name: 'webexpo2022' },
    },
    {
        path: '/2020/:degree',
        name: 'webexpo2020',
        component: Webexpo2020,
    },
    {
        path: '/2021/:degree',
        name: 'webexpo2021',
        component: Webexpo2021,
    },
    {
        path: '/2022/:degree',
        name: 'webexpo2022',
        component: Webexpo2022,
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
