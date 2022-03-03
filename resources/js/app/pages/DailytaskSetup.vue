<template>
    <div class="animated fadeIn">
        <b-col md="12">
            <b-card
                :header="appendtext + ' Monitoring Setup in Week ' + result[1]"
            >
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
                                    v-model="isChecked"
                                    name="check-button"
                                    switch
                                    size="lg"
                                    v-on:click="OnCheckbox()"
                                >
                                    <b>
                                        {{
                                            isChecked ? "OTHER" : "OSTICKET"
                                        }}</b
                                    >
                                </b-form-checkbox>
                            </b-form-group>

                            <div class="row justify-content-between text-left">
                                <div
                                    class="form-group col-sm-6 flex-column d-flex"
                                >
                                    <label class="form-control-label px-3"
                                        >Ticket<span class="text-danger">
                                            *</span
                                        ></label
                                    >
                                    <b-form-group>
                                        <b-input-group>
                                            <b-form-input
                                                v-model.trim="form.ticket"
                                                type="text"
                                                placeholder="Ticket"
                                            ></b-form-input>
                                            <!-- Attach Right button -->
                                            <b-input-group-append>
                                                <b-button
                                                    variant="primary"
                                                    :disabled="isChecked"
                                                    @click="onSearchTicket"
                                                >
                                                    <i class="fa fa-search"></i>
                                                </b-button>
                                            </b-input-group-append>
                                        </b-input-group>
                                    </b-form-group>
                                    <!-- <b-form-group>
                                        <b-input-group-prepend>
                                            <b-button variant="primary">
                                                <i class="fa fa-search"></i>
                                                Search
                                            </b-button>
                                        </b-input-group-prepend>
                                        <b-form-input
                                            type="text"
                                            v-model="form.ticket"
                                            @click="GetTicketID"
                                            :class="
                                                isChecked
                                                    ? false == 'bg-white'
                                                    : true == ' bg-gray'
                                            "
                                            :disabled="isChecked"
                                        ></b-form-input>
                                    </b-form-group> -->
                                </div>
                                <div
                                    class="form-group col-sm-6 flex-column d-flex"
                                >
                                    <label class="form-control-label px-3"
                                        >User<span class="text-danger">
                                            *</span
                                        ></label
                                    >
                                    <b-form-input
                                        type="text"
                                        v-model="form.raisedby"
                                        placeholder="User"
                                    ></b-form-input>
                                </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div
                                    class="form-group col-sm-6 flex-column d-flex"
                                >
                                    <label class="form-control-label px-3"
                                        >Branch<span class="text-danger">
                                            *</span
                                        ></label
                                    >
                                    <b-form-input
                                        type="text"
                                        v-model="form.site"
                                        placeholder="Branch"
                                    ></b-form-input>
                                </div>
                                <div
                                    class="form-group col-sm-6 flex-column d-flex"
                                >
                                    <label class="form-control-label px-3"
                                        >District<span class="text-danger">
                                            *</span
                                        ></label
                                    >
                                    <b-form-input
                                        type="text"
                                        v-model="form.district"
                                        placeholder="district"
                                    ></b-form-input>
                                </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div
                                    class="form-group col-sm-6 flex-column d-flex"
                                >
                                    <label class="form-control-label px-3"
                                        >Agent<span class="text-danger">
                                            *</span
                                        ></label
                                    >
                                    <b-form-input
                                        type="text"
                                        v-model="form.agent"
                                        placeholder="Agent"
                                    ></b-form-input>
                                </div>
                            </div>
                            <div class="row justify-content-between text-left">
                                <div
                                    class="form-group col-sm-12 flex-column d-flex"
                                >
                                    <label class="form-control-label px-3"
                                        >Subject<span class="text-danger">
                                            *</span
                                        ></label
                                    >
                                    <b-form-input
                                        type="text"
                                        v-model="form.subject"
                                        placeholder="subject"
                                    ></b-form-input>
                                </div>
                            </div>
                        </b-col>
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
            <form class="form">
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
                                    <div class="col">Subject</div>
                                    <div class="col">{{ item.Subject }}</div>
                                    <div class="w-100"></div>
                                    <div class="col">Assigned to</div>
                                    <div class="col">{{ item.Agent }}</div>
                                    <div class="w-100"></div>
                                    <div class="col">Status</div>
                                    <div class="col">{{ item.Status }}</div>
                                </div>
                            </div>
                            <br />
                            <hr />
                            <b-button
                                type="submit"
                                variant="success"
                                @click="onSelectTicketID(item)"
                            >
                                <i class="fa fa-save"></i>
                                {{ appendtext }} Tiket
                            </b-button>
                        </b-list-group-item>
                    </b-list-group>
                </div>
            </form>
        </b-modal>
        <!-- <pre>{{$data|JSON}}</pre> -->
    </div>
</template>
<script>
import Axios from "axios";
import Api from "../services/api";
export default {
    name: "DailytaskSetup",
    data() {
        return {
            result: "",
            isChecked: false,
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
                ticket: "",
                week: "",
                user_id: this.$store.state.user.id,
                site: "",
                district: "",
                type: this.isChecked ? "OTHER" : "OSTICKET",
                subject: "",
                position: "",
                department: "",
                days: "",
                hitmiss: false,
                status: false,
                sla: false,
                raisedby: "",
                remarks: "",
                agent: "",
            },
        };
    },
    mounted: function () {
        //get week of the month
        function getWeekNumber(d) {
            // Copy date so don't modify original
            d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
            // Set to nearest Thursday: current date + 4 - current day number
            // Make Sunday's day number 7
            d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
            // Get first day of year
            var yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
            // Calculate full weeks to nearest Thursday
            var weekNo = Math.ceil(((d - yearStart) / 86400000 + 1) / 7);
            // Return array of year and week number
            return [d.getUTCFullYear(), weekNo];
        }
        this.result = getWeekNumber(new Date());
        //end get week by month
    },
    methods: {
        Oncheckbox: function () {},
        checkForm: function () {
            if (this.form.ticket) {
                return true;
            } else {
                this.errors = [];

                if (!this.form.ticket) {
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
            Api.instance
                .post("/task-store", this.form)
                .then((res) => {
                    this.isShowAlert = true;
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
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
            let self = this;
            const p = self.form.ticket;
            Axios.post(
                "https://apps.fastlogistics.com.ph/mira/api/Osticket/jbp/?key=p",
                { p }
            )

                .then(function (resp) {
                    resp.data.array.forEach((element) => {
                        self.Ticket.push({});
                    });
                    //@ts-ignorethis.Ticket = resp.data.Tickets;
                    this.loading = false;
                    this.form.week = this.result[1];
                    //this.form.ticket = val.TicketNumber;
                    // this.form.raisedby = resp.data.Tickets.val.User;
                    // this.form.site = resp.data.Tickets.UserBranch;
                    // this.form.district = resp.data.Tickets.District;
                    // this.form.subject = resp.data.Tickets.Subject;
                    // this.form.agent = resp.data.Tickets.Agent;
                    // self.form = resp.data.Ticket;
                    self.form.agent = resp.data.Tickets.Agent;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        onSelectTicketID: function (val) {
            this.form.week = this.result[1];
            this.form.ticket = val.TicketNumber;
            this.form.raisedby = val.User;
            this.form.site = val.UserBranch;
            this.form.district = val.District;
            this.form.subject = val.Subject;
            this.form.agent = val.Agent;
            //this.ModalTicket = false;
        },
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
    created: function () {},
};
</script>

<style scoped></style>
