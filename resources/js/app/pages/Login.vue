<template>
    <div class="app flex-row align-items-center">
        <div class="container">
            <b-row class="justify-content-center loginForm">
                <div class="form-elegant">
                    <div class="card border-none">
                        <div class="card-body mx-4">
                            <b-form>
                                <!--Header-->
                                <h5 class="dark-grey-text text-center">
                                    <span class="ng-binding">Sign in</span>
                                </h5>
                                <!-- Fast Application -->
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
                                        />
                                    </b-input-group>

                                    <div class="dispatch-table">
                                        <p
                                            class="font-small blue-text d-flex justify-content-end"
                                        >
                                            <router-link :to="'#'"
                                                >Forgot Password?</router-link
                                            >
                                        </p>
                                    </div>
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
                                            variant="primary"
                                            class="btn btn-primary btn-block btn-rounded z-depth-1 waves-effect waves-light ng-hide"
                                            @click="
                                                show('foo-velocity', 'success')
                                            "
                                        >
                                            Notification</b-button
                                        >
                                    </div>
                                    <!--Grid column-->
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
export default {
    name: "Login",
    components: {},
    data() {
        return {
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
        animation() {
            return {
                /**
                 * Animation function
                 *
                 * Runs before animating, so you can take the initial height, width, color, etc
                 * @param  {HTMLElement}  element  The notification element
                 */
                enter(element) {
                    let height = element.clientHeight;
                    return {
                        // animates from 0px to "height"
                        height: [height, 0],

                        // animates from 0 to random opacity (in range between 0.5 and 1)
                        opacity: [Math.random() * 0.5 + 0.5, 0],
                    };
                },
                leave: {
                    height: 0,
                    opacity: 0,
                },
            };
        },
    },
    methods: {
        login: function () {
            if (this.getuservalue == undefined) {
                console.log("no token");
            }
            this.$store
                .dispatch("login", this.credentials)
                .then((resp) => {
                    this.$router.push("/dashboard");
                })
                .catch((err) => {
                    console.log(err);
                    reject(err);
                });
        },
        show(group, type = "") {
            this.$notify({
                group,
                title: "login complete",
                text: "sample",
                type,
                data: {},
            });
        },
        clean(group) {
            this.$notify({ group, clean: true });
        },
    },
};
</script>
