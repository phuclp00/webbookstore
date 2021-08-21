<template>
  <div class="myaccount-content">
    <h3>Đơn Hàng Của Tôi</h3>
    <div class="myaccount-table table-responsive text-center">
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>Mã đơn</th>
            <th>Mã khuyến mãi</th>
            <th>Hình thức vận chuyển</th>
            <th>Hình thức thanh toán</th>
            <th>Tình Trạng</th>
            <th>Tổng Tiền</th>
            <th>Ghi chú</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders" :key="order.id">
            <td>{{ order.id }}</td>
            <td>
              <span v-if="order.vouchers == null"
                >Đơn hàng này không sử dụng mã khuyến mãi</span
              >
              <span v-else class="text-danger"
                >{{ order.vouchers.code }} <br />
                Giảm giá: {{ order.vouchers.data.percent }} %</span
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
              <a :href="'/order-summary/order=' + order.id" class="btn"
                >Xem chi tiết</a
              >
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
.table-responsive {
  overflow-y: auto;
  max-height: 750px;
}
</style>