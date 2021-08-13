<template>
  <modal
    ref="childmodal"
    name="promotions_detail"
    :scrollable="true"
    :height="'auto'"
    :width="'80%'"
    :style="'z-index:1000'"
  >
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div
              class="
                iq-card-header
                d-flex
                justify-content-between
                align-items-center
              "
            ></div>
            <div class="iq-card">
              <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                  <h4 class="card-title">Order Information Process</h4>
                </div>
              </div>
              <div class="iq-card-body" v-if="data.length != 0">
                <form-wizard
                  ref="formWizard"
                  shape="circle"
                  title="Order Information Process"
                  subtitle="Check information and confim"
                  :start-index="data.order.status_id - 2"
                >
                  <wizard-step
                    slot-scope="props"
                    slot="step"
                    :tab="props.tab"
                    :transition="props.transition"
                    :key="props.tab.title"
                    :index="props.index"
                  >
                  </wizard-step>
                  <b-spinner
                    v-show="loadingWizard"
                    variant="success"
                    class="ml-auto loader"
                    style="position: fixed; z-index: 100000"
                    label="On Loading...."
                    v-text="'Loading'"
                  >
                  </b-spinner>
                  <tab-content
                    v-for="tab in status"
                    :key="tab.id"
                    :title="tab.name"
                  >
                    <div class="row" v-if="loadingComplete == false">
                      <div class="col-sm-12">
                        <div class="col-md-12 p-0">
                          <h3 class="mb-4">Order Information:</h3>
                          <div>
                            <div v-if="data.order.deleted_at != null">
                              <h4 class="text-danger">
                                Order has been cancelled/refunds by
                                {{ data.order.deleted_by }} at
                                {{ $parent.datetime(data.order.deleted_at) }}
                              </h4>
                              <button
                                class="btn btn-outline-primary"
                                @click="restore()"
                              >
                                Restore This Order
                              </button>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6 form-group">
                              <label for="uname" class="control-label"
                                >User Name:</label
                              >
                              <input
                                type="text"
                                class="form-control"
                                required="required"
                                name="uname"
                                :value="data.user.name"
                                placeholder="Enter User Name"
                                :disabled="edit"
                              />
                            </div>
                            <div class="col-md-6 form-group">
                              <label class="control-label">Email:</label>
                              <input
                                type="email"
                                class="form-control"
                                required="required"
                                name="emailid"
                                :value="data.user.email"
                                placeholder="Email ID"
                                :disabled="edit"
                              />
                            </div>
                            <div class="col-md-6 form-group">
                              <label class="control-label"
                                >Contact Number:</label
                              >
                              <input
                                type="text"
                                class="form-control"
                                required="required"
                                name="cno"
                                :value="data.user.phone"
                                :disabled="edit"
                              />
                            </div>
                            <div class="col-md-6 form-group">
                              <label class="control-label">Address:</label>
                              <input
                                type="text"
                                class="form-control"
                                required="required"
                                :value="data.order.address.address_line_1"
                                :disabled="edit"
                              />
                              <input
                                type="text"
                                class="form-control"
                                required="required"
                                :value="
                                  data.order.address.address_line_2 == null
                                    ? ''
                                    : data.order.address.address_line_2
                                "
                                :disabled="edit"
                              />
                            </div>
                            <div class="col-md-6 form-group">
                              <label class="control-label">District:</label>
                              <input
                                type="text"
                                class="form-control"
                                required="required"
                                :value="
                                  data.order.address.get_districts == null
                                    ? data.order.address.district
                                    : data.order.address.get_districts.name
                                "
                                :disabled="edit"
                              />
                            </div>
                            <div class="col-md-6 form-group">
                              <label class="control-label">Wards:</label>
                              <input
                                type="text"
                                class="form-control"
                                required="required"
                                :value="
                                  data.order.address.get_wards == null
                                    ? data.order.address.wards
                                    : data.order.address.get_wards.name
                                "
                                :disabled="edit"
                              />
                            </div>
                            <div class="col-md-6 form-group">
                              <label class="control-label">City:</label>
                              <input
                                type="text"
                                class="form-control"
                                required="required"
                                :value="
                                  data.order.address.get_city == null
                                    ? data.order.address.city
                                    : data.order.address.get_city.name
                                "
                                :disabled="edit"
                              />
                            </div>
                            <div class="col-md-6 form-group">
                              <label class="control-label">Note:</label>
                              <input
                                type="text"
                                class="form-control"
                                required="required"
                                :value="data.order.note"
                                :disabled="edit"
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="col-md-12 p-0">
                          <h3 class="mb-4">Product List:</h3>
                          <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Book Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                v-for="(item, key) in data.order.books"
                                :key="key"
                              >
                                <th scope="row">{{ key + 1 }}</th>
                                <td>
                                  <a :href="'/shop/' + item.book_name">{{
                                    item.book_name
                                  }}</a>
                                </td>
                                <td>
                                  {{
                                    item.price
                                      | currency("VND", 0, {
                                        symbolOnLeft: false,
                                      })
                                  }}
                                </td>
                                <td>{{ item.pivot.quantity }}</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="3" class="text-center">
                                  Order Total:
                                </th>
                                <td>
                                  {{
                                    data.order.final_price
                                      | currency("VND", 0, {
                                        symbolOnLeft: false,
                                      })
                                  }}
                                </td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <fieldset v-else>
                      <div class="form-card">
                        <div class="row">
                          <div class="col-7">
                            <h3 class="mb-4 text-left">Finish:</h3>
                          </div>
                          <div class="col-5">
                            <h2 class="steps">
                              {{ $parent.datetime(data.order.modified_at) }} by
                              {{ data.order.modified_by }}
                            </h2>
                          </div>
                        </div>
                        <br /><br />
                        <h2 class="text-success text-center">
                          <strong>SUCCESS !</strong>
                        </h2>
                        <br />
                        <div class="row justify-content-center">
                          <div class="col-3">
                            <img
                              src="/images/others/img-success.png"
                              class="fit-image"
                              alt="fit-image"
                            />
                          </div>
                        </div>
                        <br /><br />
                        <div class="row justify-content-center">
                          <div class="col-7 text-center">
                            <h5 class="purple-text text-center">
                              Complete Orders For Users
                            </h5>
                            <div>
                              <button
                                v-if="data.order.deleted_at == null"
                                class="btn btn-outline-danger"
                                @click="cancelOrder()"
                              >
                                Refunds This Order
                              </button>
                              <button
                                v-else
                                class="btn btn-outline-primary"
                                @click="restore()"
                              >
                                Restore This Order
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                  </tab-content>
                  <!-- Slot Footer Scope -->
                  <template slot="footer" slot-scope="props">
                    <div
                      class="wizard-footer-left"
                      v-show="data.order.deleted_at == null"
                    >
                      <wizard-button
                        v-if="props.activeTabIndex >= 0 && !props.isLastStep"
                        @click.native="cancelOrder()"
                        :style="props.fillButtonStyle"
                        >Cancel Order</wizard-button
                      >
                    </div>
                    <div class="wizard-footer-right">
                      <wizard-button
                        ref="next-wizard"
                        v-if="!props.isLastStep"
                        @click.native="changeStatusOrder(props.activeTabIndex)"
                        class="wizard-footer-right"
                        :style="props.fillButtonStyle"
                        >Next Steps</wizard-button
                      >

                      <wizard-button
                        v-else
                        class="wizard-footer-right finish-button"
                        :style="props.fillButtonStyle"
                      >
                        {{
                          props.isLastStep ? "Complete Order" : "Next"
                        }}</wizard-button
                      >
                    </div>
                  </template>
                </form-wizard>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></modal
  >
</template>
              
<script>
import moment from "moment";
export default {
  data() {
    return {
      data: [],
      status: [],
      edit: true,
      loadingWizard: false,
    };
  },
  computed: {
    loadingComplete() {
      return (
        this.data.order.status.id == this.status[this.status.length - 1].id
      );
    },
  },
  methods: {
    show_model: function (item) {
      this.$modal.show("promotions_detail");
      return (this.data = item);
    },
    get_status() {
      axios.get("/api/status").then((response) => {
        this.status = response.data;
      });
    },
    cancelOrder(order, id, email) {
      this.loadingWizard = true;
      Vue.nextTick(() => {
        axios
          .delete(
            "/admin/orders/order=" +
              this.data.order.id +
              "/user=" +
              this.data.user.email
          )
          .then((response) => {
            this.loadingWizard = false;
            this.$root.makeToast(response.data.status, response.data.mess);
            if (response.data.status == "success") {
              this.data.status = response.data.data;
              this.$parent.$parent.$parent.$parent.get_order_guest();
              this.$parent.$parent.$parent.$parent.get_order_user();
            }
          });
      });
    },
    restore() {
      this.loadingWizard = true;
      Vue.nextTick(() => {
        axios
          .post("/admin/orders/restore", {
            order: this.data.order.id,
            email: this.data.user.email,
          })
          .then((response) => {
            this.loadingWizard = false;
            this.$root.makeToast(response.data.status, response.data.mess);
            if (response.data.status == "success") {
              this.data.status = response.data.data;
              this.$parent.$parent.$parent.$parent.get_order_guest();
              this.$parent.$parent.$parent.$parent.get_order_user();
            }
          });
      });
    },
    changeStatusOrder(index) {
      this.loadingWizard = true;
      Vue.nextTick(() => {
        axios
          .post("/admin/orders/change-status", {
            order: this.data.order,
            id: index + 2,
            email: this.data.user.email,
          })
          .then((response) => {
            this.loadingWizard = false;
            this.$root.makeToast(response.data.status, response.data.mess);
            if (response.data.status == "success") {
              this.$refs.formWizard.nextTab();
              return [
                this.loadingComplete,
                this.$parent.$parent.$parent.$parent.get_order_guest(),
                this.$parent.$parent.$parent.$parent.get_order_user(),
              ];
            } else {
              return false;
            }
          });
      });
    },
  },
  created() {
    this.get_status();
  },
};
</script>

<style scoped>
</style>