
<template>
  <div class="iq-card">
    <b-tabs content-class="mt-3" card>
      <!-- User Account -->
      <b-tab :title="user_type" class="card-title" active>
        <div class="table-responsive">
          <table
            id="datatable"
            class="
              table table-bordered table-responsive-md table-striped
              text-center
            "
            role="grid"
            aria-describedby="user-list-page-info"
          >
            <thead class="thead-light">
              <tr id="user_list_header">
                <th>STT</th>
                <th>User Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>State</th>
                <th>Join Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in list_user" :key="user.user_id">
                <td>{{ user.user_id }}</td>
                <td>
                  {{ user.user_name }}
                </td>
                <td>
                  This user already have
                  <b class="text-danger">{{ user.address.length }}</b> address,
                  and <b class="text-danger"> {{ user.phone.length }}</b> number
                  phone. <br />
                  <a
                    href="javascript:void(0)"
                    @click="OpenAddressPhoneModal(user)"
                    >CLick to see</a
                  >
                </td>
                <td>
                  <a>{{ user.email }} </a>
                </td>

                <td>
                  <span v-if="user.status == 1" class="badge iq-bg-primary">
                    Online</span
                  >
                  <span v-else class="badge iq-bg-danger">Offline</span>
                </td>

                <td>
                  <p>
                    {{ datetime(user.created_at) }}
                  </p>
                  <span>{{ timeago(user.created_at) }}</span>
                </td>
                <td>
                  <div class="flex align-items-center list-user-action option">
                    <a
                      class="iq-bg-primary"
                      data-toggle="tooltip"
                      data-placement="top"
                      title="Show Detail"
                      data-original-title="Detail"
                      href="javascript:void(0)"
                      @click="showdetail(user)"
                      ><i class="ri-user-add-line"></i
                    ></a>
                    <a
                      v-if="user.deleted_at == null"
                      class="iq-bg-primary"
                      data-toggle="tooltip"
                      data-placement="top"
                      title="Delete"
                      @click="delete_user(user)"
                      data-original-title="Delete"
                      href="javascript:void(0)"
                      ><i class="ri-delete-bin-line"></i
                    ></a>
                    <a
                      v-else
                      class="bg-primary"
                      data-toggle="tooltip"
                      data-placement="top"
                      title="Restore"
                      data-original-title="Restore"
                      @click="restore_user(user)"
                      href="javascript:void(0)"
                      ><i class="fa fa-undo"></i>
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="thead-light"></tr>
            </tfoot>
          </table>
        </div>
      </b-tab>
      <!-- Guest -->
      <b-tab title="Guest" class="card-title" v-if="list_guest != 'null'">
        <div class="table-responsive">
          <table
            id="datatable_guest"
            class="
              table table-bordered table-responsive-md table-striped
              text-center
            "
            role="grid"
            aria-describedby="user-list-page-info"
          >
            <thead class="thead-light">
              <tr id="user_list_header">
                <th>ID</th>
                <th>User Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Email</th>
                <th>State</th>
                <th>Join Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in list_guest" :key="user.id">
                <td>{{ user.user_id }}</td>
                <td>
                  {{ user.full_name }}
                </td>
                <td>
                  {{ user.phone }}
                </td>
                <td v-if="user.address">
                  <span>{{
                    user.address.address_line_1 +
                    ", " +
                    user.address.address_line_2 +
                    ", " +
                    user.address.district +
                    ", " +
                    user.address.wards +
                    ", " +
                    user.address.city +
                    ", " +
                    user.address.country +
                    ", " +
                    user.address.zip_code
                  }}</span>
                </td>
                <td v-else>
                  <span>This user do not have an address </span>
                </td>
                <td>
                  <a>{{ user.email }} </a>
                </td>

                <td>
                  {{ user.created_by }}
                </td>

                <td>
                  <p>
                    {{ datetime(user.created_at) }}
                  </p>
                  <span>{{ timeago(user.created_at) }}</span>
                </td>
                <td>
                  <div class="flex align-items-center list-user-action option">
                    <a
                      class="iq-bg-primary"
                      data-toggle="tooltip"
                      data-placement="top"
                      title="Show Detail"
                      data-original-title="Detail"
                      href="javascript:void(0)"
                      @click="show_guest_detail(user)"
                      ><i class="ri-user-add-line"></i
                    ></a>
                    <a
                      v-if="user.deleted_at == null"
                      class="iq-bg-primary"
                      data-toggle="tooltip"
                      data-placement="top"
                      title=""
                      data-original-title="Delete"
                      @click="delete_guest(user)"
                      href="javascript:void(0)"
                      ><i class="ri-delete-bin-line"></i
                    ></a>
                    <a
                      v-else
                      class="bg-primary"
                      data-toggle="tooltip"
                      data-placement="top"
                      title="Restore"
                      data-original-title="Restore"
                      @click="restore_guest(user)"
                      href="javascript:void(0)"
                      ><i class="fa fa-undo"></i>
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="thead-light"></tr>
            </tfoot>
          </table>
        </div>
      </b-tab>
      <!-- Modal address -->
      <b-modal
        ref="address-phone-modal"
        size="xl"
        title="Address and Phone Number List"
      >
        <div>
          <h3>Address List</h3>
          <b-table hover :items="addressList" :fields="addressField"></b-table>
          <div>
            <h3>Phone List</h3>
            <b-table hover :items="phoneList" :fields="phoneField"></b-table>
          </div>
        </div>
      </b-modal>
    </b-tabs>
    <b-modal
      id="modal-prevent-closing"
      ref="modal"
      title="User Detail"
      size="xl"
    >
      <b-table :items="user" :fields="account_field"></b-table>
      <b-button @click="reset_password(user)"> Reset Password</b-button>
      <b-button @click="open_voucher_modal()">
        Send Vouchers to this user</b-button
      >
      <b-button @click="open_history_order(user)">
        Check History Order</b-button
      >
    </b-modal>
    <b-modal ref="guest-modal" title="Guest Address Infomation" size="xl">
      <b-table :items="user" :fields="guestField"></b-table>
      <b-button @click="open_guest_history_order(user)">
        Check History Order</b-button
      >
    </b-modal>
    <b-modal id="voucher-modal" ref="voucher-modal" title="Create Voucher">
      <!-- Discount Percent -->
      <b-form-group
        label="Enter % discount you want before create voucher"
        label-for="input-formatter"
        class="mb-0"
      >
        <b-form-input
          id="input-voucher"
          v-model="percent"
          type="number"
          placeholder="Enter percent"
          :state="voucherState"
          aria-describedby=" input-live-feedback"
        ></b-form-input>
        <b-form-invalid-feedback id="input-live-feedback">
          Discount percent at least is 1% and maximum is 99%
        </b-form-invalid-feedback>
      </b-form-group>
      <!-- Date Expired -->
      <b-form-group
        label="Select Date Expired"
        label-for="input-date"
        class="mb-0"
      >
        <b-form-datepicker
          v-model="expired"
          :min="mindate"
          locale="en"
        ></b-form-datepicker>
      </b-form-group>
      <!-- Number of uses -->
      <b-form-group
        label="Enter number of uses"
        label-for="input-number-uses"
        class="mb-0"
      >
        <b-form-input
          id="input-number-uses"
          v-model="number_of_uses"
          type="number"
          :state="numberState"
          placeholder="Enter number of uses"
        ></b-form-input>
      </b-form-group>
      <!-- Minimum amount -->
      <b-form-group
        label="Enter the minimum amount to use"
        label-for="input-amount"
        class="mb-0"
      >
        <b-form-input
          id="input-amount"
          v-model="amount"
          type="number"
          placeholder="Enter the minimum amount to use"
          :state="amountState"
          aria-describedby=" input-live-feedback"
        ></b-form-input>
        <b-form-invalid-feedback id="input-live-feedback">
          Minimum amount must start from 0
        </b-form-invalid-feedback>
      </b-form-group>
      <!-- Button -->
      <b-form-group class="mb-0">
        <b-button variant="outline-primary" @click="createVoucher"
          >Send<b-spinner small type="grow" v-show="loading">
            Loading...
          </b-spinner></b-button
        >
      </b-form-group>
    </b-modal>
    <b-modal
      id="modal-history-order"
      :title="'Order Infomation:'"
      ref="modal-history-order"
      size="xl"
    >
      <table
        class="
          table table-bordered table-responsive-md table-striped
          text-center
        "
      >
        <tr>
          <th>Order Id</th>
          <th>Voucher Used</th>
          <th>Shipping Method</th>
          <th>Payment Method</th>
          <th>Status</th>
          <th>Final Price</th>
          <th>Note</th>
          <th>Created At</th>
        </tr>
        <tr v-for="order in orders" :key="order.id">
          <td>{{ order.id }}</td>
          <td>
            <span v-if="order.vouchers == null"
              >This order not use voucher</span
            >
            <span v-else
              >{{ order.vouchers.code }} <br />
              {{ order.vouchers.data.percent }} % discount</span
            >
          </td>
          <td>{{ order.shipping.method }}</td>
          <td>{{ order.payment.name }}</td>
          <td>{{ order.status.name }}</td>
          <td>
            {{
              order.final_price | currency("VND", 0, { symbolOnLeft: false })
            }}
          </td>
          <td>{{ order.note }}</td>
          <td>{{ datetime(order.created_at) }}</td>
        </tr>
      </table>
    </b-modal>
  </div>
</template>
<script>
import moment from "moment";
export default {
  props: ["users", "guest", "user_type"],
  data() {
    return {
      addressField: [
        "id",
        "address_line_1",
        "address_line_2",
        "wards",
        "district",
        "city",
        "country",
        "zip_code",
        "created_at",
      ],
      addressList: [],
      phoneField: ["id", "number", "created_at", "modified_at"],
      phoneList: [],
      isHidden: false,
      account_field: [
        "user_id",
        "user_name",
        "email",
        "membership",
        "created_at",
        "created_by",
        "modified_at",
        "modified_by",
      ],
      guestField: [
        "address.id",
        "address.address_line_1",
        "address.address_line_2",
        "address.wards",
        "address.district",
        "address.city",
        "address.country",
        "address.zip_code",
      ],
      user: [],
      percent: 0,
      amount: 0,
      expired: null,
      number_of_uses: 1,
      orders: [],
      loading: false,
      list_user: [],
      list_guest: [],
    };
  },
  mounted() {
    $(document).ready(function () {
      $.noConflict();
      $("#datatable").DataTable({
        dom: "Bfrtip",
        buttons: [
          {
            extend: "copyHtml5",
            exportOptions: {
              columns: [0, 1, 3, 4],
            },
            className: " btn-outline-primary",
            text: "Copy to clipboard",
            key: {
              key: "C",
              altkey: true,
            },
            titleAttr: "Press C on the keyboard or click into to Copy ",
          },
          {
            extend: "excelHtml5",
            className: " btn-outline-primary",
            exportOptions: {
              columns: [0, 1, 3, 4],
            },
            text: "Export to Excel",
            key: {
              key: "E",
              altkey: true,
            },
            titleAttr: "Press E on the keyboard or click into to Export ",
          },
          {
            extend: "pdfHtml5",
            exportOptions: {
              columns: [0, 1, 3, 4],
            },
            className: " btn-outline-primary",
            text: "Export to PDF",
            key: {
              key: "D",
              altkey: true,
            },
            download: "open",
            titleAttr: "Press D on the keyboard or click into to Export ",
          },
          {
            extend: "csvHtml5",
            exportOptions: {
              columns: [0, 1, 3, 4],
            },
            className: " btn-outline-primary",
            text: "Export to CSV",
            key: {
              key: "V",
              altkey: true,
            },
            titleAttr: "Press V on the keyboard or click into to Export ",
          },
          {
            extend: "print",
            exportOptions: {
              columns: [0, 1, 3, 4],
            },
            className: "buttons-html5 btn-outline-primary",
            text: "Print",
            key: {
              key: "p",
              altkey: true,
            },
            titleAttr: "Press P on the keyboard or click into to print",
          },
        ],
      });
      $("#datatable_guest").DataTable({
        dom: "Bfrtip",
        buttons: [
          {
            extend: "copyHtml5",
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5],
            },
            className: " btn-outline-primary",
            text: "Copy to clipboard",
            key: {
              key: "C",
              altkey: true,
            },
            titleAttr: "Press C on the keyboard or click into to Copy ",
          },
          {
            extend: "excelHtml5",
            className: " btn-outline-primary",
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5],
            },
            text: "Export to Excel",
            key: {
              key: "E",
              altkey: true,
            },
            titleAttr: "Press E on the keyboard or click into to Export ",
          },
          {
            extend: "pdfHtml5",
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5],
            },
            className: " btn-outline-primary",
            text: "Export to PDF",
            key: {
              key: "D",
              altkey: true,
            },
            download: "open",
            titleAttr: "Press D on the keyboard or click into to Export ",
          },
          {
            extend: "csvHtml5",
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5],
            },
            className: " btn-outline-primary",
            text: "Export to CSV",
            key: {
              key: "V",
              altkey: true,
            },
            titleAttr: "Press V on the keyboard or click into to Export ",
          },
          {
            extend: "print",
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5],
            },
            className: "buttons-html5 btn-outline-primary",
            text: "Print",
            key: {
              key: "p",
              altkey: true,
            },
            titleAttr: "Press P on the keyboard or click into to print",
          },
        ],
      });
    });
  },
  computed: {
    voucherState() {
      if (parseInt(this.percent) > 1 && parseInt(this.percent) < 100) {
        return true;
      }
      return false;
    },
    amountState() {
      return this.amount >= 0 ? true : false;
    },
    numberState() {
      return this.number_of_uses > 0 ? true : false;
    },
    mindate() {
      const now = new Date();
      const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
      return today;
    },
  },
  methods: {
    datetime(date) {
      return moment(date).format("DD/MM/YYYY");
    },
    timeago(date) {
      return moment(date).startOf("hours").fromNow();
    },
    delete_user(user) {
      axios.delete("/admin/users/user/" + user.user_id).then((response) => {
        this.$root.makeToast(response.data.status, response.data.mess);
        if (response.data.status == "success") {
          return (this.list_user = response.data.data);
        }
        return false;
      });
    },
    delete_guest(user) {
      axios
        .post("/admin/users/guest/restore" + user.user_id)
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          if (response.data.status == "success") {
            return (this.list_guest = response.data.data);
          }
          return false;
        });
    },
    restore_user(user) {
      axios
        .post("/admin/users/user/restore", { id: user.user_id })
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          if (response.data.status == "success") {
            return (this.list_user = response.data.data);
          }
          return false;
        });
    },
    restore_guest(user) {
      axios
        .post("/admin/users/guest/restore", { id: user.user_id })
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          if (response.data.status == "success") {
            return (this.list_guest = response.data.data);
          }
          return false;
        });
    },
    createVoucher() {
      if (
        this.voucherState == false ||
        this.amountState == false ||
        this.numberState == false
      ) {
        return this.$root.makeToast(
          "danger",
          "Voucher type invalid ! Check again"
        );
      }
      this.loading = true;
      axios
        .post("./vouchers", {
          user: this.user,
          percent: this.percent,
          amount: this.amount,
          expired: this.expired,
          number_of_uses: this.number_of_uses,
        })
        .then((response) => {
          this.loading = false;
          this.percent = 0;
          this.amount = 0;
          this.expired = "";
          this.number_of_uses = 0;
          return this.$root.makeToast(response.data.status, response.data.mess);
        });
    },
    OpenAddressPhoneModal(user) {
      this.addressList = user.address.filter((data) => {
        return [
          (data.wards =
            data.get_wards == null ? data.wards : data.get_wards.name),
          (data.district =
            data.get_districts == null
              ? data.district
              : data.get_districts.name),
          (data.city = data.get_city == null ? data.city : data.get_city.name),
          (data.created_at = this.datetime(data.created_at)),
        ];
      });
      this.phoneList = user.phone.filter((data) => {
        return [
          (data.created_at = this.datetime(data.created_at)),
          (data.modified_at = this.datetime(data.modified_at)),
        ];
      });
      return this.$refs["address-phone-modal"].show();
    },
    show_guest_detail(user) {
      this.user = [];
      this.user.push(user);
      return this.$refs["guest-modal"].show();
    },
    showdetail(user) {
      this.user = [];
      axios.post("/admin/users/show", { user: user.email }).then((response) => {
        this.user.push(response.data);
        this.user.filter((data) => {
          return [
            ((data.membership = data.membership.type),
            (data.modified_at = this.datetime(data.modified_at)),
            (data.created_at = this.datetime(data.created_at))),
          ];
        });
        Vue.nextTick(() => {
          return this.$refs["modal"].show();
        });
      });
    },
    open_voucher_modal() {
      return this.$refs["voucher-modal"].show();
    },
    open_history_order(user) {
      this.orders = [];
      axios
        .post("/admin/orders/show", { id: user[0].user_id })
        .then((response) => {
          this.orders = response.data.data;
          this.$root.makeToast(response.data.status, response.data.mess);
          Vue.nextTick(() => {
            return this.$refs["modal-history-order"].show();
          });
        });
    },
    open_guest_history_order(user) {
      this.orders = [];
      axios
        .post("/admin/orders/guest/show", { id: user[0].user_id })
        .then((response) => {
          this.orders = response.data.data;
          this.$root.makeToast(response.data.status, response.data.mess);
          Vue.nextTick(() => {
            return this.$refs["modal-history-order"].show();
          });
        });
    },
    resetModal() {
      this.name = "";
      this.nameState = null;
    },
    handleSubmit() {
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
    },
    reset_password() {
      axios
        .post("/admin/users/reset-password", { email: this.user[0].email })
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
        });
    },
  },
  created() {
    this.list_user = this.users;
    this.list_guest = this.guest;
  },
};
</script>
<style scoped>
td {
  margin: 0 auto;
}
td > span:first-child {
  color: #fd7e14;
}
span {
  color: var(--iq-primary);
}
</style>
