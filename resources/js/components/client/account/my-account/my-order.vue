<template>
  <div class="myaccount-content">
    <h3>Đơn Hàng Của Tôi</h3>
    <div class="myaccount-table table-responsive text-center">
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>No</th>
            <th>Voucher Used</th>
            <th>Shipping Method</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th>Final Price</th>
            <th>Note</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
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
            <td>{{ $root.datetime(order.created_at) }}</td>
            <td>
              <a :href="'/order-summary/order=' + order.id" class="btn">View</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      orders: [],
    };
  },
  methods: {
    get_order_list() {
      axios
        .post("/my-account/orders", { id: this.user.user_id })
        .then((response) => {
          this.orders = response.data.data;
        });
    },
  },
  created() {
    this.get_order_list();
  },
};
</script>

<style>
</style>