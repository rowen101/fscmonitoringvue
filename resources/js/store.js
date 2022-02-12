import Vue from "vue";
import Vuex from "vuex";
import createPersistedState from "vuex-persistedstate";
import axios from "axios";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        status: "",
        token: localStorage.getItem("auth") || "",
        user: {},
        apiName: "",
        nav: [],
        perPage: 10,

        isLoading: false,
    },
    computed: {},
    plugins: [
        createPersistedState({
            key: "Monitoring",
        }),
    ],
    mutations: {
        setToken(state, token) {
            localStorage.setItem("auth", token);
            state.token = token;
        },
        clearToken(state) {
            localStorage.removeItem("auth");
            state.token = "";
        },

        auth_error(state) {
            state.status = "error";
        },
        logout(state) {
            localStorage.removeItem("auth");
            state.status = "";
            state.token = "";
            state.user = "";
            state.isWarehouse = false;
            state.branches = "";
            state.site = "";
            state.firstname = "";
            state.selectedWarehouse = "";
            state.warehousecode = "";
            state.warehousedesc = "";
            state.isLoading = false;
            state.apiName = "";
        },
        warehouse(state, isWarehouse) {
            state.isWarehouse = isWarehouse;
        },
        filter(state, isFilter) {
            state.isFilter = isFilter;
        },
        branches(state, branches) {
            state.branches = branches;
        },
        site(state, site) {
            state.site = site;
        },
        firstname(state, firstname) {
            state.firstname = firstname;
        },
        accountName(state, accountName) {
            state.accountName = accountName;
        },
        selectedWarehouse(state, selectedWarehouse) {
            state.selectedWarehouse = selectedWarehouse;
            localStorage.setItem(
                "selectedWarehouse",
                selectedWarehouse.serverwarehouseId
            );
        },
        warehousecode(state, data) {
            state.warehousecode = data.warehousecode;
            state.warehousedesc = data.warehousedesc;
        },
        setLoading(state, isLoading) {
            state.isLoading = isLoading;
        },
        setNav(state, newStateNav) {
            state.nav = newStateNav;
        },
    },
    actions: {},
    getters: {
        isLoggedIn: (state) => !!state.token,
        authStatus: (state) => state.status,
        apiName: (state) => state.apiName,
        isFilter: (state) => state.isFilter,
        site: (state) => state.site,
        firstname: (state) => state.firstname,
        token: (state) => state.token,
        isLoading: (state) => state.isLoading,
        user: (state) => state.user,
        nav: (state) => state.nav,
        perPage: (state) => state.perPage,
    },
});
