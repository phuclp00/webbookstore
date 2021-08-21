<template>
  <table
    id="datatable"
    class="data-tables table table-striped table-bordered fixed"
    style="width: 100%"
  >
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Body</th>
        <th>Rate</th>
        <th>User</th>
        <th>Product Name</th>
        <th>Date Created</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="value in ratings" :key="value.id">
        <td>{{ value.id }}</td>
        <td>{{ value.title }}</td>
        <td>{{ value.comment }}</td>
        <td>
          <span>{{ value.rating }}/5</span>
        </td>
        <td>{{ value.user.user_name }}</td>
        <td>{{ value.book.book_name }}</td>
        <td>{{ datetime(value.created_at) }}</td>
        <td>
          <div class="flex align-items-center list-user-action">
            <a
              class="bg-primary"
              data-toggle="tooltip"
              data-placement="top"
              title="Delete"
              data-original-title="Delete"
              @click="showModal(value)"
              ><i class="ri-delete-bin-line"></i
            ></a>
          </div>
        </td>
      </tr>
    </tbody>
    <b-modal
      id="modal-prevent-closing"
      ref="modal"
      title="Deleting this comment"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOk"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group
          label="Reason for rating deletion:"
          label-for="name-input"
          invalid-feedback="Reason is required"
          :state="nameState"
        >
          <b-form-input
            id="name-input"
            v-model="name"
            :state="nameState"
            required
          ></b-form-input>
        </b-form-group>
      </form>
    </b-modal>
  </table>
</template>

<script>
import moment from "moment";
export default {
  props: ["data"],
  components: { moment },
  data() {
    return {
      ratings: [],
      name: "",
      nameState: null,
      item: [],
    };
  },
  methods: {
    datetime(date) {
      return moment(date).format("DD/MM/YYYY");
    },
    timeago(date) {
      return moment(date).startOf("hours").fromNow();
    },
    showModal(item) {
      this.item = item;
      this.$refs.modal.show();
    },
    hideModal() {
      this.$refs.modal.hide();
    },
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.nameState = valid;
      return valid;
    },
    resetModal() {
      this.name = "";
      this.nameState = null;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      this.handleSubmit();
    },
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return;
      }
      // Push the name to submitted names
      axios
        .delete("/admin/users/rating/delete" + this.item.id + "&&" + this.name)
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          // Hide the modal manually
          this.$nextTick(() => {
            this.$bvModal.hide("modal-prevent-closing");
          });
          if (response.data.status == "success") {
            this.item = [];
            return (this.ratings = response.data.data);
          }
        });
    },
  },
  created() {
    this.ratings = this.data;
    $(document).ready(function () {
      $.noConflict();
      var table = $("#datatable").DataTable({});
      new $.fn.dataTable.Buttons($("#datatable"), {
        buttons: [
          {
            extend: "copyHtml5",
            exportOptions: {
              columns: [0, 1, 2, 3, 4, 5, 6],
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
              columns: [0, 1, 2, 3, 4, 5, 6],
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
              columns: [0, 1, 2, 3, 4, 5, 6],
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
              columns: [0, 1, 2, 3, 4, 5, 6],
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
              columns: [0, 1, 2, 3, 4, 5, 6],
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