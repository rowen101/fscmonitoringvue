<template>
    <div class="animated fadeIn">
        <b-col md="12">
            <b-card header>
                <div slot="header">
                    <span>Daily Task Monitoring</span>
                    <a
                        href="#"
                        class="btn btn-sm btn-info float-right ml-1"
                        id="printpagebutton"
                        @click="onPrint"
                    >
                        <i class="fa fa-print"></i> Print
                    </a>
                    <button
                        id="printexport"
                        class="btn btn-sm btn-info float-right"
                        @click="onexport"
                    >
                        Export
                    </button>
                </div>
                <div class="newButton">
                    <b-button
                        variant="success"
                        class="btnsm"
                        @click="OnClinkNEwIndicator()"
                    >
                        <i class="fa fa-plus-circle"></i>&nbsp;New Ticket
                    </b-button>
                </div>
                <b-row>
                    <b-col md="4" class="my-1">
                        <b-form-group label-cols-sm="1" class="mb-0">
                            <b-input-group>
                                <b-form-input
                                    v-model="filter"
                                    placeholder="Type to Search"
                                />
                                <b-input-group-append>
                                    <b-button
                                        :disabled="!filter"
                                        @click="filter = ''"
                                        >Clear</b-button
                                    >
                                </b-input-group-append>
                            </b-input-group>
                        </b-form-group>
                    </b-col> </b-row
                >&nbsp;
                <b-table
                    show-empty
                    stacked="md"
                    responsive="sm"
                    hover
                    small
                    striped
                    fixed
                    head-variant="light"
                    :busy.sync="isBusy"
                    :items="items"
                    :fields="fields"
                    :per-page="perPage"
                    :filter="filter"
                >
                    <template slot="action_button" slot-scope="data">
                        <b-button
                            variant="primary"
                            class="btn btn-primary btn-sm btn-square"
                            @click="
                                OnClinkUpdateIndicator(data.item.indicatorId)
                            "
                        >
                            <i class="fa fa-pencil-square-o"></i> </b-button
                        >&nbsp;
                        <!-- <router-link
                  tag="button"
                  class="btn btn-primary btn-sm btn-square"
                  :to="'/Maintenance/2017042003480096/modify/indicator/' + data.item.indicatorId"

                >
                  <i class="fa fa-pencil-square-o"></i>
                </router-link>&nbsp; -->
                        <b-button
                            size="sm"
                            variant="danger"
                            class="btn btn-danger btn-sm btn-square"
                            @click="onSelecteItemToDelete(data.item)"
                        >
                            <i class="fa fa-trash-o"></i>
                        </b-button>
                    </template>
                    <template slot="description" slot-scope="data">
                        <div class="ellipsis">
                            <span v-b-popover.hover="data.item.description">{{
                                data.item.description
                            }}</span>
                        </div>
                    </template>
                    <template slot="valuedatatype" slot-scope="data">{{
                        valueTypeToLemans(data.item.valuedatatype)
                    }}</template>
                    <template slot="status" slot-scope="data">
                        <i
                            :class="
                                data.item.status == 'A'
                                    ? 'activeStatus icon-check active_icon'
                                    : 'inactiveStatus icon-close inactive_icon'
                            "
                        ></i>
                    </template>
                </b-table>
            </b-card>
            <div style="margin-top: 5px">
                <b-pagination
                    size="sm"
                    :total-rows="totalItem"
                    v-model="currentPage"
                    :per-page="perPage"
                    @input="onPageSelect"
                ></b-pagination>
            </div>
        </b-col>
    </div>
</template>
<script>
export default {
    name: "Dailytask",
    data() {
        return {};
    },
    methods: {
        back: function () {
            this.$router.push("/dailytask-setup");
        },
        onPrint: function (evt) {
            evt.preventDefault();
            // this.isHidden = true;
            var printButton = document.getElementById("printpagebutton");
            var printExport = document.getElementById("printexport");
            var breadView = document.getElementById("breadview");
            //Set the print button visibility to 'hidden'
            printButton.style.visibility = "hidden";
            printExport.style.visibility = "hidden";
            breadView.style.visibility = "hidden";
            //Print the page content
            window.print();
            printButton.style.visibility = "visible";
            printExport.style.visibility = "visible";
            breadView.style.visibility = "visible";
        },
        onexport: function () {
            JSONToCSVConvertor(this.items, "Indicator List", true);
        },
        OnClinkNEwIndicator: function () {
            this.$router.push("/dailytask/add");
        },
    },
};
</script>

<style scoped></style>
