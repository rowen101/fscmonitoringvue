import Vue from "vue";
import Router from "vue-router";

import Home from "./pages/Home.vue";
import Login from "./pages/Login.vue";
import Dashboard from "./pages/Dashboard";
import Monitoring from "./pages/Monitoring";

Vue.use(Router);
let router = new Router({
    mode: "hash", // Demo is living in GitHub.io, so required!
    //linkActiveClass: "open active",
    scrollBehavior: () => ({
        y: 0,
    }),
    routes: [
        {
            path: "/",
            name: "Home",
            component: Home,
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: Dashboard,
        },
        {
            path: "/monitoring",
            name: "monitoring",
            component: Monitoring,
        },
        {
            path: "/login",
            name: "login",
            component: Login,
        },
        // {
        //     path: "/dashboard",
        //     redirect: "/dashboard",
        //     name: "Dashboard",
        //     component: Dashboard,
        // },
        // {
        //     path: "/monitoring",
        //     component: Monitoring,
        // },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        //console.log(store.getters.isLoggedIn);
        // if (store.getters.isLoggedIn) {
        //     next();
        //     return;
        // }
        next("/login");
    } else {
        next();
    }
});
export default router;
