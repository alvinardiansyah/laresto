import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './views/Home.vue';
import About from './views/About.vue';
import Login from './views/Login.vue';
import Register from './views/Register.vue';

import Dashboard from './views/dashboard/Dashboard.vue';
import Admin from './views/dashboard/Admin.vue';
import Manager from './views/dashboard/Manager.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/dashboard',
            component: Dashboard,
            children: [
                {
                    path: 'admin',
                    name: 'dashboard.admin',
                    component: Admin
                },
                {
                    path: 'manager',
                    name: 'dashboard.manager',
                    component: Manager
                }
            ]
        }
    ]
});

export default router;