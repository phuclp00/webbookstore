<template>
  <div>
    <group-input-tags ref="data"></group-input-tags>
    <table
      id="datatable"
      class="data-tables table table-striped table-bordered fixed"
      style="width: 100%"
    >
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Percentage Discount</th>
          <th>Date Expired</th>
          <th>Date Create</th>
          <th>Modified By</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="value in promotions" :key="value.id">
          <td>{{ value.id }}</td>
          <td>{{ value.name }}</td>
          <td>{{ value.percent + " %" }}</td>
          <td>
            {{ value.date_expired }}
            <p v-if="value.date_expired > moment()" class="bg-primary">
              On Going
            </p>
            <p v-else class="bg-danger">Expried</p>
          </td>
          <td>{{ datetime(value.created_at) }}</td>
          <td>
            {{
              value.modified_by == null ? value.created_by : value.modified_by
            }}
          </td>
          <td>
            <div class="flex align-items-center list-user-action">
              <a
                class="bg-primary"
                data-toggle="tooltip"
                :data-text="value.id"
                data-placement="top"
                title="Detail"
                data-original-title="Detail"
                @click="showModal(value)"
              >
                <i class="ri-file-fill"></i
              ></a>
              <a
                class="bg-primary option-edit"
                data-toggle="tooltip"
                data-placement="top"
                title="Edit"
                data-original-title="Edit"
                :href="'/admin/promotions/promotions-edit-view/' + value.id"
                ><i class="ri-pencil-line"></i
              ></a>
              <a
                v-if="value.deleted_at != null"
                class="bg-primary option-restore"
                data-toggle="tooltip"
                data-placement="top"
                title="Restore"
                data-original-title="Restore"
                :href="'/admin/promotions/promotions-restore/' + value.id"
                ><i class="fa fa-undo"></i
              ></a>
              <a
                v-else
                class="bg-primary option-delete"
                data-toggle="tooltip"
                data-placement="top"
                title="Delete"
                data-original-title="Delete"
                :href="'/admin/promotions/promotions-delete/' + value.id"
                ><i class="ri-delete-bin-line"></i
              ></a>
            </div>
          </td>
        </tr>
      </tbody>
      <modal-promotions :detail="data[0]" ref="reference"></modal-promotions>
    </table>
  </div>
</template>

<script>
import moment from "moment";
Vue.component(
  "group-input-tags",
  require("./group/promotion_group.vue").default
);
Vue.component("modal-promotions", require("./modal/promotions.vue").default);
export default {
  props: ["data", "router"],
  components: { moment },
  data() {
    return {
      promotions: [],
    };
  },
  methods: {
    datetime(date) {
      return moment(date, "YYYY-MM-DD").format("DD/MM/YYYY");
    },
    moment() {
      return moment().format("YYYY-MM-DD H:i:s");
    },
    timeago(date) {
      return moment(date).startOf("hours").fromNow();
    },
    showModal(item) {
      this.$refs.reference.show_model(item);
    },
    hideModal() {
      this.$refs.modal.hide();
    },
  },
  mounted() {
    this.promotions = this.data;
  },
  created() {
    $(document).ready(function () {
      $.noConflict();
      var table = $("#datatable").DataTable({});
      new $.fn.dataTable.Buttons($("#datatable"), {
        buttons: [
          {
            extend: "copyHtml5",
            exportOptions: {
              columns: [0, 1, 3, 4, 5],
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
              columns: [0, 1, 3, 4, 5],
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
              columns: [0, 1, 3, 4, 5],
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
              columns: [0, 1, 3, 4, 5],
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
              columns: [0, 1, 3, 4, 5],
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

      table.buttons(0, null).container().prependTo(table.table().container());
    });
  },
};
</script>
<style>
</style>