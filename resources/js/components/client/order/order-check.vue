<template>
  <section class="order-complete inner-page-sec-padding-bottom">
    <div class="container">
      <div class="order-complete-message text-center">
        <h1>Theo dõi đơn hàng của bạn</h1>
      </div>
      <div class="col">
        <div class="header-search-block">
          <input
            type="text"
            v-model="value"
            placeholder="Nhập mã đơn hàng của bạn......"
          />
          <button @click="find()">Tìm kiếm</button>
        </div>
      </div>
      <div class="row">
        <div v-if="loading" class="col-12 d-flex justify-content-center mb-3">
          <b-spinner class="m-5" variant="success" label="Spinning">
          </b-spinner>
        </div>
        <div v-else class="col-12">
          <div v-if="order.length != 0">
            <div class="order-complete-message text-center m-md-5">
              <h2>Kết quả hiện thị cho đơn hàng :{{ order.id }}</h2>
              <p>Trạng thái đơn hàng : {{ order.status.name }}</p>
              <button
                class="btn btn-outline-danger"
                v-if="order.status.percent <= 70"
                @click="showModal()"
              >
                Yêu cầu hủy đơn hàng
              </button>
              <button
                class="btn btn-outline-danger"
                v-if="order.status.percent == 100"
                @click="showModal()"
              >
                Trả hàng
              </button>
              <b-progress
                :value="order.status.percent"
                :variant="set_status(order.status.percent)"
                striped
                animated
              ></b-progress>
            </div>
            <ul class="order-details-list">
              <li>
                Mã đơn hàng: <strong>{{ order.id }}</strong>
              </li>
              <li>
                Ngày tạo:
                <strong>{{ $root.datetime(order.created_at) }}</strong>
              </li>
              <li>
                Tổng tiền:
                <strong>{{
                  order.final_price
                    | currency("đ", 0, {
                      symbolOnLeft: false,
                      spaceBetweenAmountAndSymbol: true,
                    })
                }}</strong>
              </li>
              <li>
                Hình thức thanh toán: <strong>{{ order.payment.name }}</strong>
              </li>
            </ul>
            <h3 class="order-table-title">Chi Tiết Đơn Hàng</h3>
            <div class="table-responsive">
              <table class="table order-details-table">
                <thead>
                  <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Tiền</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in order.books" :key="item.book_id">
                    <td>
                      <a :href="'/shop/' + item.book_name">{{
                        item.book_name
                      }}</a>
                      <strong>× {{ item.pivot.quantity }}</strong>
                    </td>
                    <td>
                      <span>{{
                        item.price
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</span
                      ><br />
                      <i>
                        <small
                          >(Số tiền dựa trên giá trị hiện tại của sản
                          phẩm)</small
                        >
                      </i>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Tạm tính:</th>
                    <td>
                      <span>{{
                        total(order.books)
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</span>
                    </td>
                  </tr>
                  <tr>
                    <th>Mã khuyến mãi:</th>
                    <td v-if="order.vouchers">
                      <span class="text-danger">
                        {{ order.vouchers.code }} ( -
                        {{ order.vouchers.data.percent }} % )
                      </span>
                    </td>
                    <td v-else>
                      <span>Đơn hàng này không sử dụng mã khuyến mãi.</span>
                    </td>
                  </tr>
                  <tr>
                    <th>Tổng giá trị thực đã thanh toán:</th>
                    <td>
                      <span>{{
                        order.final_price
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</span>
                    </td>
                  </tr>
                  <tr>
                    <th>Lời nhắn/ Ghi chú cho đơn hàng</th>
                    <td>{{ order.note }}</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div v-else>
            <div class="order-complete-message text-center m-md-5">
              <p>{{ mess }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <b-modal
      id="modal-prevent-closing"
      ref="modal"
      title="Yêu cầu hủy đơn hàng"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOk"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group
          label="Lý do bạn hủy đơn hàng :"
          label-for="name-input"
          invalid-feedback="Reason is required"
          :state="nameState"
        >
          <b-form-input
            id="name-input"
            list="list"
            v-model="name"
            :state="nameState"
            required
          ></b-form-input>
          <datalist id="list">
            <option v-for="(index, key) in options" :key="key">
              {{ index }}
            </option>
          </datalist>
        </b-form-group>
      </form>
    </b-modal>
  </section>
</template>

<script>
export default {
  data() {
    return {
      order: [],
      value: "",
      loading: false,
      mess: "",
      name: "",
      nameState: null,
      options: [
        "Tôi đã đợi quá lâu",
        "Tôi đổi ý muốn mua sản phẩm khác",
        "Tôi hết tiền rồi",
        "Sản phẩm không đúng với chất lượng",
        "Không Thích ?",
      ],
    };
  },
  computed: {},
  methods: {
    find() {
      this.loading = true;
      axios.get("/order-finding/" + this.value).then((response) => {
        this.loading = false;
        if (response.data.status == "success") {
          return (this.order = response.data.data);
        } else {
          return (this.mess = response.data.mess);
        }
      });
    },
    total(book) {
      let total = 0;
      book.forEach((data) => {
        return (total += data.pivot.quantity * data.price);
      });
      return total;
    },
    set_status(status) {
      let state = "";
      switch (status) {
        case 30:
          state = "info";
          break;
        case 50:
          state = "warning";
          break;

        case 70:
          state = "primary";
          break;

        case 100:
          state = "success";
          break;
      }
      return state;
    },
    showModal() {
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
        .post("/request/orders", { id: this.order.id, mess: this.name })
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          // Hide the modal manually
          this.$nextTick(() => {
            this.$bvModal.hide("modal-prevent-closing");
          });
        });
    },
  },
};
</script>

<style>
</style>