import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
import Dashboard from '../components/Dashboard.vue';
import TrashNotes from '../components/TrashNotes.vue';
import ViewNote from '../components/ViewNote.vue';
import store from "../store";

Vue.use(VueRouter)

const routes = [
    {
        path:'',
        redirect: "/dashboard",
    },
    {
        meta: {isGuest: true},
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        meta: {isGuest: true},
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        meta: { requiresAuth: true },
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
    },
    {
        meta: { requiresAuth: true },
        path: "/viewNote/:id",
        name: "ViewNote",
        component: ViewNote,
    },
    {
        meta: { requiresAuth: true },
        path: "/trash",
        name: "TrashNotes",
        component: TrashNotes,
    }

]

const router = new VueRouter({
mode: 'history',
routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        next({ name: "Login" });
    } else if (localStorage.getItem('token') && to.meta.isGuest) {
        next({ name: "Dashboard" });
    } else {
        next();
    }
});
  
export default router;