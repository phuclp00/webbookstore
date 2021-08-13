<template>
  <table
    :id="'datatable_' + type + '_order'"
    class="data-tables table table-striped table-bordered fixed"
    style="width: 100%"
  >
    <thead>
      <tr>
        <th>ID</th>
        <th>Date Created</th>
        <th>Created By</th>
        <th>Name Customer</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Modified At</th>
        <th>Modified By</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="value in orders" :key="value.id">
        <td>{{ value.order.id }}</td>
        <td>{{ datetime(value.order.created_at) }}</td>
        <td>{{ value.order.created_by }}</td>
        <td>{{ value.user.name }}</td>
        <th>{{ value.order.final_price }}</th>
        <td>
          <span>{{ value.order.status.name }}</span>
          <p class="bg-danger">{{ value.order.status.percent }}%</p>
        </td>
        <td>{{ datetime(value.order.modified_at) }}</td>
        <td>{{ value.order.modified_by }}</td>
        <td>
          <div class="flex align-items-center list-user-action">
            <a
              class="bg-primary"
              data-toggle="tooltip"
              :data-text="value.id"
              data-placement="top"
              title="Check Order Now"
              data-original-title="Detail"
              @click="showModal(value)"
            >
              <i class="las la-poll-h"></i>
            </a>
          </div>
        </td>
      </tr>
    </tbody>
    <modal-order ref="childmodal"></modal-order>
  </table>
</template>
<script>
import moment from "moment";
export default {
  props: ["orders", "type"],
  data() {
    return {};
  },
  methods: {
    datetime(date) {
      return moment(date, "YYYY-MM-DD").format("DD/MM/YYYY");
    },
    moment() {
      return moment().format("YYYY-MM-DD h:mm:ss");
    },
    timeago(date) {
      return moment(date).startOf("hours").fromNow();
    },
    showModal(item) {
      this.$refs.childmodal.show_model(item);
    },
  },
};
</script>

<style>
</style>