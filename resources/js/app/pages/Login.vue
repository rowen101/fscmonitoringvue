<template>
    <div class="app flex-row align-items-center">
        <div class="container">
            <b-row class="justify-content-center loginForm">
                <div class="form-elegant">
                    <div class="card border-none">
                        <div class="card-body mx-4">
                            <!-- <b-alert :show="errors.length > 0" variant="danger">
                                <h6 class="alert-heading">
                                    Please fill in all required field!
                                </h6>
                                <ul>
                                    <li
                                        v-for="(error, i) in errors"
                                        :key="`error-${i}`"
                                    >
                                        {{ error }}
                                    </li>
                                </ul>
                            </b-alert> -->
                            <b-form>
                                <!--Header-->
                                <h1>Login</h1>

                                <!--Body-->
                                <div class="md-form">
                                    <b-input-group class="mb-3">
                                        <b-input-group-prepend>
                                            <b-input-group-text>
                                                <i class="icon-user"></i>
                                            </b-input-group-text>
                                        </b-input-group-prepend>
                                        <input
                                            type="text"
                                            v-model="credentials.email"
                                            class="form-control"
                                            placeholder="Username"
                                            autocomplete="username email"
                                            required
                                        />
                                    </b-input-group>
                                </div>

                                <div class="md-form pb-3 password">
                                    <b-input-group class="mb-4">
                                        <b-input-group-prepend>
                                            <b-input-group-text>
                                                <i class="icon-lock"></i>
                                            </b-input-group-text>
                                        </b-input-group-prepend>
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="Password"
                                            autocomplete="current-password"
                                            v-model="credentials.password"
                                            v-on:keyup.enter="login"
                                        />
                                    </b-input-group>

                                    <p
                                        class="font-small blue-text d-flex justify-content-end"
                                    >
                                        <router-link :to="'#'"
                                            >Forgot Password?</router-link
                                        >
                                    </p>
                                </div>

                                <div class="row d-flex align-items-center mb-4">
                                    <!--Grid column-->

                                    <div class="text-center mb-3 col-md-12">
                                        <b-button
                                            variant="primary"
                                            class="btn btn-primary btn-block btn-rounded z-depth-1 waves-effect waves-light ng-hide"
                                            @click="login"
                                            >Login</b-button
                                        >
                                    </div>

                                    <div class="text-center mb-3 col-md-12">
                                        <b-button
                                            variant="success"
                                            class="btn btn-primary btn-block btn-rounded z-depth-1 waves-effect waves-light ng-hide"
                                            @click="register"
                                            >Create new Account</b-button
                                        >
                                    </div>
                                </div>
                            </b-form>
                        </div>

                        <!--Footer-->
                    </div>
                </div>
            </b-row>
        </div>
        <notifications
            group="foo-velocity"
            position="bottom right"
            :speed="500"
        />
    </div>
</template>

<script>
import miniToastr from "mini-toastr";
miniToastr.init();
export default {
    name: "Login",
    components: {},
    data() {
        return {
            errors: [],

            filter: null,
            credentials: {
                email: "",
                password: "",
            },
            loading: true,
        };
    },
    computed: {
        getuservalue: {
            get: function () {
                return this.$store.getters.isLoggedIn;
            },
            set: function (value) {
                this.$store.commit("setToken", value);
            },
        },
    },
    methods: {
        // checkForm: function (e) {
        //     if (
        //         this.credentials.email &&
        //         this.credentials.password &&

        //     ) {
        //         return true;
        //     }

        //     this.errors = [];
        //     if (!this.credentials.email) {
        //         this.errors.push("email required.");
        //     }
        //     if (!this.credentials.password) {
        //         this.errors.push("password required.");
        //     }

        //     e.preventDefault();
        // },
        login: function () {
            //  evt.preventDefault();
            // if (!this.checkForm()) {
            //     return;
            // }
            if (this.getuservalue == undefined) {
                console.log("no token");
            }
            this.$store
                .dispatch("login", this.credentials)
                .then((resp) => {
                    // miniToastr.success("Login " + resp.data.success);
                    this.$router.push("/dashboard");
                })
                .catch((err) => {
                    miniToastr.error(err.data);
                });
        },

        register() {
            this.$router.push("/register");
        },
    },
};
</script>
