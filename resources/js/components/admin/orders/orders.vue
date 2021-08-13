<template>
  <div id="iq-card">
    <b-tabs content-class="mt-3" card>
      <b-tab title="Order User Account">
        <user :orders="list_order_user" :type="'user'"></user>
      </b-tab>
      <b-tab title="Order by Guest">
        <user :orders="list_order_guest" :type="'guest'"></user>
      </b-tab>
    </b-tabs>
  </div>
</template>
<script>
Vue.component("modal-order", require("./modal/orders.vue").default);
import user from "./group/user.vue";
export default {
  props: ["type"],
  components: { user },
  data() {
    return {
      order_user: [],
      order_guest: [],
    };
  },
  mounted() {},
  computed: {
    list_order_user() {
      return this.order_user.filter((data) => {
        if (this.type == "restore") {
          return data.order.deleted_at != null;
        } else if (this.type == "ongoing" && data.order.deleted_at == null) {
          return data.order.status.percent != "100";
        } else {
          return data.order.status.percent == "100";
        }
      });
    },
    list_order_guest() {
      return this.order_guest.filter((data) => {
        if (this.type == "restore") {
          return data.order.deleted_at != null;
        } else if (this.type == "ongoing" && data.order.deleted_at == null) {
          return data.order.status.percent != "100";
        } else {
          return data.order.status.percent == "100";
        }
      });
    },
  },
  methods: {
    get_order_user() {
      axios.get("/admin/orders/user-list").then((response) => {
        return (this.order_user = response.data.filter((data) => {
          return [
            (data.user.name = data.user.user_name),
            (data.user.phone = data.user.phone[0].number),
          ];
        }));
      });
    },
    get_order_guest() {
      axios.get("/admin/orders/guest-list").then((response) => {
        return (this.order_guest = response.data.filter((data) => {
          return [(data.user.name = data.user.full_name)];
        }));
      });
    },
  },
  created() {
    this.get_order_guest();
    this.get_order_user();
    setTimeout(() => {
      $(document).ready(function () {
        $.noConflict();
        $("#datatable_user_order").DataTable({
          dom: "Bfrtip",
          buttons: [
            {
              extend: "copyHtml5",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7],
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
                columns: [0, 1, 2, 3, 4, 5, 6, 7],
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
                columns: [0, 1, 2, 3, 4, 5, 6, 7],
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
                columns: [0, 1, 2, 3, 4, 5, 6, 7],
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
                columns: [0, 1, 2, 3, 4, 5, 6, 7],
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
        $("#datatable_guest_order").DataTable({
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
    }, 5000);
  },
};
</script>
<style>
</style>