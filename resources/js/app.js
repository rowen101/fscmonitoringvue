//require("./bootstrap");
import Vue from "vue";
import App from "./app/pages/App";
import router from "./app/router";
import store from "./store";
import BootstrapVue from "bootstrap-vue";
import VueRouterBackButton from "vue-router-back-button";
import "./polyfill";
import miniToastr from "mini-toastr";
import Vselect from "vue-select";
miniToastr.init();
Vue.use(VueRouterBackButton, { router });
Vue.use(BootstrapVue);
Vue.component("v-select", Vselect);
// Vue.use(VueRouter);
// const router = new VueRouter({
//     routes: routes,
//     mode: "history",
// });
// const app = new Vue({
//     el: "#app",
//     router,
//     store,
//     render: (app) => app(App),
// });
new Vue({
    el: "#app",
    router,
    store: store,
    template: "<App/>",
    components: {
        App,
    },
});
