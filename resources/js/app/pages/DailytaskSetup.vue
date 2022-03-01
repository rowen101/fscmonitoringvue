<template>
    <div class="animated fadeIn">
        <b-col md="12">
            <b-card :header="appendtext + ' Monitoring Setup'">
                <b-alert
                    :show="isShowAlert"
                    variant="success"
                    isShowAlert="false"
                >
                    <p>
                        {{ appendtext }} Save Complete
                        <b-button
                            v-show="buttonishow"
                            size="sm"
                            variant="primary"
                            @click="reload"
                        >
                            <i class="fa fa-plus-circle"></i>&nbsp;Monitoring
                        </b-button>
                    </p>
                </b-alert>
                <b-form @submit="onSubmit" v-if="!isShowAlert">
                    <b-alert :show="errors.length > 0" variant="danger">
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
                    </b-alert>
                    <b-row>
                        <b-col>
                            <b-form-group>
                                <b-form-checkbox
                                    v-model="checkbox"
                                    name="check-button"
                                    switch
                                    size="lg"
                                    v-on:click="OnCheckbox()"
                                >
                                    <b>Ticket: {{ checkbox }}</b>
                                </b-form-checkbox>
                            </b-form-group>
                            <b-form-group label="Ticket No*">
                                <input
                                    type="text"
                                    class="form-control bg-white"
                                    readonly
                                    v-model="form.ticketno"
                                    @click="GetTicketID"
                                    :disabled="checkbox == 1"
                                />
                            </b-form-group>
                        </b-col>
                        <b-col
                            ><b-form-group>
                                <label for="remarks">Ticket no*</label>
                                <b-form-input
                                    type="text"
                                    id="remarks"
                                    v-model.trim="form.ticketno"
                                    placeholder="Ticket"
                                ></b-form-input> </b-form-group
                        ></b-col>
                    </b-row>

                    <div class="dispatch-table">
                        <b-button type="submit" variant="primary">
                            <i class="fa fa-save"></i>
                            {{ appendtext }}
                        </b-button>
                    </div>
                    <div class="dispatch-list">
                        <b-button
                            type="submit"
                            variant="primary"
                            class="btn btn-primary btn-sm btn-block"
                        >
                            <i class="fa fa-save"></i>
                            {{ appendtext }}
                        </b-button>
                    </div>
                </b-form>
            </b-card>
        </b-col>
        <b-modal v-model="ModalTicket" title="Select Ticket" hide-footer>
            <input
                type="Text"
                placeholder="Search"
                v-model="Searchticketid"
                v-on:keyup.enter="onSearchTicket"
                class="form-control mb-2"
            />
            <span v-if="Ticket == null"> no ticket</span>
            <form class="form" v-else>
                <div style="height: auto; overflow-x: auto">
                    <b-list-group>
                        <b-list-group-item
                            v-for="(item, index) in Ticket"
                            :key="index"
                        >
                            <div>
                                <div v-if="loading">
                                    <div class="spinner-border" role="role">
                                        <span class="sr-only">loading...</span>
                                    </div>
                                </div>

                                <div class="row" v-else>
                                    <div class="col">TicketNumber</div>
                                    <div class="col">
                                        {{ item.TicketNumber }}
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col">User</div>
                                    <div class="col">{{ item.User }}</div>
                                    <div class="w-100"></div>
                                    <div class="col">Branch</div>
                                    <div class="col">{{ item.UserBranch }}</div>
                                    <div class="w-100"></div>
                                    <div class="col">Assigned to</div>
                                    <div class="col">{{ item.Agent }}</div>
                                    <div class="w-100"></div>
                                    <div class="col">Status</div>
                                    <div class="col">{{ item.Status }}</div>
                                </div>
                            </div>
                        </b-list-group-item>
                    </b-list-group>
                </div>
                <br />
                <hr />
                <b-button type="submit" variant="success">
                    <i class="fa fa-save"></i>
                    {{ appendtext }} Tiket
                </b-button>
            </form>
        </b-modal>
        <!-- <pre>{{$data|JSON}}</pre> -->
    </div>
</template>
<script>
import Axios from "axios";
export default {
    name: "DailytaskSetup",
    data() {
        return {
            checkbox: false ? 0 : 1,
            checkboxval: true,
            loading: true,
            ModalTicket: false,
            errors: [],
            Ticket: [],
            checklistIdoptions: [],
            isShowAlert: false,
            Searchticketid: "",
            buttonishow: this.$route.params.id == undefined ? true : false,
            appendtext:
                this.$route.params.id == undefined ? "Create" : "Update",
            form: {
                id:
                    this.$route.params.id == undefined
                        ? ""
                        : this.$route.params.id,
                ticketno: "",
            },
        };
    },
    methods: {
        Oncheckbox: function () {
            // this.checkbox = (checkbox + 1) % 2;
        },
        checkForm: function () {
            if (this.form.ticketno) {
                return true;
            } else {
                this.errors = [];

                if (!this.form.ticketno) {
                    this.errors.push("ticket no required.");
                }

                return false;
            }
        },
        onSubmit: function (evt) {
            evt.preventDefault();
            if (this.checkForm() == false) {
                return;
            }
        },
        reload: function () {
            this.$router.go(this.$router.currentRoute);
        },
        back: function () {
            this.$router.push("/dailytask");
        },
        GetTicketID: function () {
            let self = this;

            self.ModalTicket = true;
        },
        onSearchTicket: function () {
            const p = this.Searchticketid;
            Axios.post(
                "https://apps.fastlogistics.com.ph/mira/api/Osticket/jbp/?key=p",
                { p }
            )

                .then((resp) => {
                    this.Ticket = resp.data.Tickets;
                    this.loading = false;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    onSelectTicketID: function (val) {
        console.log("git data");
    },
    computed: {
        filterchecklistid: function () {
            var self = this;
            return self.checklistIdoptions.filter(function (cust) {
                return (
                    cust.ticketno
                        .toLowerCase()
                        .indexOf(self.Searchticketid.toLowerCase()) >= 0
                );
            });
        },
    },
};
</script>

<style scoped></style>
