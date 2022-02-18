import Vue from "vue";
import Router from "vue-router";
import store from "../store";
import Home from "./pages/Home.vue";
import Login from "./pages/Login.vue";
import Register from "./pages/Register.vue";
import Dashboard from "./pages/Dashboard";
import DailyTask from "./pages/DailyTask";
import Pmdevice from "./pages/Pmdevice";
import Page404 from "./pages/Page404";
// Containers
const DefaultContainer = () => import("./containers/DefaultContainer");

Vue.use(Router);
let router = new Router({
    mode: "hash", // Demo is living in GitHub.io, so required!
    linkActiveClass: "open active",
    scrollBehavior: () => ({
        y: 0,
    }),
    routes: [
        {
            path: "/dashboard",
            name: "Home",
            icon: "icon-speedometer",
            component: DefaultContainer,
            meta: {
                requiresAuth: true,
            },
            children: [
                {
                    path: "/dashboard",
                    name: "dashboard",
                    component: Dashboard,
                },
                {
                    path: "/dailytask",
                    name: "dailytask",
                    component: DailyTask,
                },
                {
                    path: "/pmdevice",
                    name: "PMdevice",
                    component: Pmdevice,
                },
            ],
        },
        {
            path: "/login",
            name: "login",
            component: Login,
        },
        {
            path: "/register",
            name: "register",
            component: Register,
        },
        {
            path: '/404',
            name: 'Page404',
            component: Page404
          },
    ],
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        console.log(store.getters.isLoggedIn);
        if (store.getters.isLoggedIn) {
            next();
            return;
        }
        next("/login");
    } else {
        next();
    }
});
export default router;
