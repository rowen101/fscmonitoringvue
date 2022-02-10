require("./bootstrap");
import Vue from "vue";
import App from "./app/pages/App";
import router from "./app/router";
// import VueRouter from "vue-router";
import BootstrapVue from "bootstrap-vue";
import VueRouterBackButton from "vue-router-back-button";

Vue.use(VueRouterBackButton, { router });
Vue.use(BootstrapVue);
// Vue.use(VueRouter);
// const router = new VueRouter({
//     routes: routes,
//     mode: "history",
// });
const app = new Vue({
    el: "#app",
    router,
    render: (app) => app(App),
});
