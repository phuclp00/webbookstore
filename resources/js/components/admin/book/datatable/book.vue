<template>
  <table id="datatable" class="table table-striped table-bordered fixed">
    <thead>
      <tr>
        <th style="width: 5%">Id</th>
        <th style="width: 10%">Book Image</th>
        <th style="width: 15%">Book Name</th>
        <th style="width: 10%">View</th>
        <th style="width: 10%">Sales</th>
        <th style="width: 10%">Created</th>
        <th style="width: 10%">Modified</th>
        <th style="width: 10%">Price</th>
        <th style="width: 10%">Promotions</th>
        <th style="width: 5%">Rating</th>
        <th style="width: 5%">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in books" :key="item.book_id">
        <td id="book_id">{{ item.book_id }}</td>
        <td v-if="item.img != 'undefined'">
          <img
            v-if="item.img != null"
            class="img-fluid"
            style="max-width: 100%; height: auto"
            :src="'/' + item.img"
            alt="Book Image"
          />
          <img
            v-else
            src="/images/books/default.jpg"
            class="img-fluid"
            style="max-width: 100%; height: auto"
            alt="Book Images"
          />
        </td>
        <td v-else>
          <img
            class="img-fluid rounded"
            style="max-width: 100%; height: auto"
            :src="'/images/books/default.jpg'"
            alt=" Default Image Book "
          />
        </td>
        <td>{{ item.book_name }}</td>
        <td>
          <span class="font-size-20 badge iq-bg-primary">{{
            item.view != null ? item.view : 0
          }}</span>
        </td>
        <td>
          <span class="font-size-20 badge iq-bg-danger">{{
            item.sales != null ? item.sales : 0
          }}</span>
        </td>
        <td>{{ datetime(item.created_at) }}</td>
        <td>{{ datetime(item.modified_at) }}</td>
        <td>
          {{
            item.price
              | currency("đ", 0, {
                symbolOnLeft: false,
                spaceBetweenAmountAndSymbol: true,
              })
          }}
        </td>
        <td style="color: red">
          {{
            item.promotion == null
              ? "Without any promotions yet"
              : item.promotion.name
          }}
        </td>
        <td>
          <span class="text-warning">{{ load_avg(item.rating) }}/5</span>
        </td>
        <td>
          <div class="flex align-items-center list-user-action">
            <a
              class="bg-primary"
              data-toggle="tooltip"
              :data-text="item.book_id"
              data-placement="top"
              title="Book Detail"
              data-original-title="Detail"
              @click="showModal(item)"
            >
              <i class="ri-file-fill"></i
            ></a>
            <a
              class="bg-primary option-edit"
              data-toggle="tooltip"
              data-placement="top"
              title=""
              data-original-title="Edit"
              :data-value="item.book_id"
              :href="'/admin/books/book-edit-view/' + item.book_id"
              ><i class="ri-pencil-line"></i
            ></a>
            <a
              v-if="item.out_of_business == 0"
              class="bg-primary option-edit"
              data-toggle="tooltip"
              :data-text="item.out_of_business"
              data-placement="top"
              title=""
              data-original-title="Stop selling"
              :href="'/admin/books/book-stop-selling/book_id=' + item.book_id"
              ><i class="fa fa-stop-circle-o"></i
            ></a>
            <a
              v-else
              class="bg-primary option-edit"
              data-toggle="tooltip"
              :data-text="item.out_of_business"
              data-placement="top"
              title=""
              data-original-title="Continue to sell"
              :href="
                '/admin/books/book-continue-to-sale/book_id=' + item.book_id
              "
              ><i class="fa fa-check"></i
            ></a>
            <a
              v-if="item.deleted_at == null"
              class="bg-primary option-delete"
              data-toggle="tooltip"
              :data-text="item.book_id"
              data-placement="top"
              title=""
              data-original-title="Delete"
              :href="'/admin/books/book-delete/book_id=' + item.book_id"
              ><i class="ri-delete-bin-line"></i
            ></a>
          </div>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th style="width: 5%">Id</th>
        <th style="width: 10%">Book Image</th>
        <th style="width: 15%">Book Name</th>
        <th style="width: 10%">View</th>
        <th style="width: 10%">Sales</th>
        <th style="width: 10%">Created</th>
        <th style="width: 10%">Modified</th>
        <th style="width: 10%">Price</th>
        <th style="width: 10%">Promotions</th>
        <th style="width: 5%">Rating</th>
        <th style="width: 5%">Action</th>
      </tr>
    </tfoot>
    <modal-book :detail="books[0]" ref="reference"></modal-book>
  </table>
</template>
<script>
Vue.component("modal-book", require("../modal/book_detail.vue").default);
import moment from "moment";

export default {
  props: ["books", "router"],
  methods: {
    datetime(date) {
      return moment(date).format("DD/MM/YYYY");
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
    load_avg(rating) {
      if (rating.length == 0) {
        return 0;
      }
      let rate = 0;
      rating.forEach((data) => {
        return (rate += data.pivot.rating);
      });
      return rate / rating.length;
    },
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
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
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
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
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
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
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
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
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
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
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