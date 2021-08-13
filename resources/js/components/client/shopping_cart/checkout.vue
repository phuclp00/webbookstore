<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <!-- Checkout Form s-->
        <div class="checkout-form">
          <div class="row row-40">
            <div class="col-12">
              <h1 class="quick-title">Thanh Toán</h1>
              <!-- Slide Down Trigger  -->
              <div class="checkout-quick-box">
                <p>
                  <i class="far fa-sticky-note"></i>Bạn đã có mã khuyến mãi ?
                  <a
                    href="javascript:0"
                    class="slide-trigger"
                    data-target="#quick-cupon"
                  >
                    Ấn vào đây để nhập mã khuyến mãi của bạn</a
                  >
                </p>
              </div>
              <!-- Slide Down Blox ==> Cupon Box -->
              <div class="checkout-slidedown-box" id="quick-cupon">
                <div class="checkout_coupon">
                  <input
                    type="text"
                    class="mb-0"
                    placeholder="Mã Khuyến Mãi"
                    v-model="voucher"
                  />
                  <button
                    class="btn btn-outlined"
                    @click="apply_voucher(voucher)"
                  >
                    Áp Dụng Mã Khuyến Mãi
                  </button>
                </div>
              </div>
            </div>
            <div class="col-lg-7 mb--20">
              <b-button
                :aria-expanded="collapse1 ? 'true' : 'false'"
                aria-controls="collapse-1"
                variant="success"
                @click="collapse1_open()"
                >Thanh Toán Khi Nhận Hàng
              </b-button>
              <b-button
                :aria-expanded="collapse2 ? 'true' : 'false'"
                aria-controls="collapse-2"
                class="m-1"
                @click="collapse2_open()"
                >Thanh Toán Online</b-button
              >
              <b-collapse id="collapse-1" class="mt-2" v-model="collapse1">
                <shippingaddress
                  ref="shipping_address"
                  :user_address="user"
                ></shippingaddress>
              </b-collapse>
              <b-collapse id="collapse-2" class="mt-2" v-model="collapse2">
                <div id="billing-form" class="mb-40">
                  <h4 class="checkout-title">
                    Thanh toán với Paypal <br />
                    Hoặc thẻ VISA
                  </h4>
                  <div class="row">
                    <div class="col">
                      <div id="paypal-button-container"></div>
                    </div>
                  </div>
                </div>
              </b-collapse>
            </div>
            <div class="col-lg-5">
              <div class="row">
                <!-- Cart Total -->
                <div class="col-12">
                  <div class="checkout-cart-total">
                    <h2 class="checkout-title">Đơn Hàng Của Bạn</h2>
                    <h4>Danh Sách Sản Phẩm <span>Giá tiền</span></h4>
                    <ul>
                      <li v-for="item in cart" :key="item.book_id">
                        <span class="left"
                          >{{ item.book_name }} X {{ item.quantity }}</span
                        >
                        <span class="right">{{
                          item.price
                            | currency("đ", 0, {
                              symbolOnLeft: false,
                              spaceBetweenAmountAndSymbol: true,
                            })
                        }}</span>
                      </li>
                    </ul>
                    <p>
                      Sub Total
                      <span>{{
                        subtotal
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</span>
                    </p>
                    <p>
                      Bảng Giá Vận Chuyển
                      <span>{{
                        selected
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</span>
                    </p>
                    <discount-detail ref="old_price">
                      {{
                        old_price
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</discount-detail
                    >
                    <h4>
                      Tổng Tiền
                      <span>{{
                        grandtotal
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</span>
                    </h4>

                    <div class="method-notice mt--25">
                      <div>
                        <b-form-group
                          label="Chọn Hình Thức Vận Chuyển"
                          v-slot="{ ariaDescribedby }"
                        >
                          <b-form-radio-group
                            v-model="selected"
                            :options="shipp_method"
                            :aria-describedby="ariaDescribedby"
                            class="mb-3"
                            value-field="price"
                            text-field="method"
                          ></b-form-radio-group>
                        </b-form-group>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import shippingaddress from "./shipping_adress.vue";
Vue.component("discount-detail", {
  data() {
    return {
      mess: "",
    };
  },
  updated() {
    this.mess;
  },
  render: function (createElement) {
    if (this.mess) {
      //<h4>Được giảm giá <span> <del class='text-danger'> 100% </del></span></h4>
      return createElement("div", [
        createElement("h4", { class: "text-danger " }, [this.mess]),
        createElement("h4", { class: "text-danger " }, [
          "Giá cũ:",
          createElement("span", [createElement("del", this.$slots.default)]),
        ]),
      ]);
    }
  },
});
export default {
  components: { shippingaddress },
  props: ["user"],
  data() {
    return {
      cart: [],
      collapse1: false,
      collapse2: false,
      loaded: false,
      padFor: false,
      selected: 0,
      shipp_method: [],
      total_price: 0,
      voucher: "",
      discount: 0,
      show: false,
      quantity_check: false,
    };
  },
  mounted() {
    const script = document.createElement("script");
    script.src =
      "https://www.paypal.com/sdk/js?client-id=AQeUKSMX7FzvRmoUR0WAR0f-Wa7Lrxbdtymd6-oJOjhApdIdK1T9TIapDQ543t1sOz9awHc_PCG7mY7I&locale=en_VN&debug=true";
    script.addEventListener("load", this.setLoaded);
    document.body.appendChild(script);
  },
  methods: {
    shipping() {
      axios.get("./api/shipping").then((response) => {
        return (this.shipp_method = response.data);
      });
    },
    check_quantity() {
      axios
        .post("/api/checkout/check-quantity", {
          cart: this.$store.state.cart,
        })
        .then((response) => {
          if (response.data.status == "success") {
            return (this.quantity_check = true);
          } else {
            this.$root.makeToast(response.data.status, response.data.mess);
            return (this.quantity_check = false);
          }
        });
    },
    collapse1_open() {
      if (this.$store.state.cart.length == 0) {
        return this.$root.makeToast("danger", "Giỏ Hàng Trống");
      } else {
        this.check_quantity();
        Vue.nextTick(() => {
          if (this.quantity_check) {
            return (this.collapse1 = !this.collapse1), (this.collapse2 = false);
          } else {
            return false;
          }
        });
      }
    },
    get_list_item() {
      var check = true;
      if (this.$store.state.cart.length > 0) {
        this.$store.state.cart.forEach((data) => {
          if (data.quantity < 1) {
            check = false;
            return this.$root.makeToast(
              "danger",
              "Kiểm tra lại số lượng sản phẩm trong giỏ hàng của bạn ! Vui lòng Liên hệ bộ phận CSKH để được giải đáp thắc mắc !"
            );
          }
        });
        if (check) {
          axios
            .post("/api/checkout/get-item-shoppingcart", {
              cart: this.$store.state.cart,
            })
            .then((response) => {
              if (response.data.status == "success") {
                this.cart = response.data.data;
              }
              return this.$root.makeToast(
                response.data.status,
                response.data.mess
              );
            });
        }
      } else {
        return this.$root.makeToast("danger", "Giỏ hàng không được để trống");
      }
    },
    collapse2_open() {
      if (this.$store.state.cart.length == 0) {
        return this.$root.makeToast("danger", "Giỏ Hàng Trống");
      } else {
        this.check_quantity();
        Vue.nextTick(() => {
          if (this.quantity_check) {
            return (this.collapse2 = !this.collapse2), (this.collapse1 = false);
          } else {
            return false;
          }
        });
      }
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    apply_voucher(voucher) {
      if (this.$store.state.cart.length == 0) {
        return this.$root.makeToast("danger", "Giỏ Hàng Trống");
      }
      if (voucher) {
        axios
          .post("./api/checkout/vouchher", {
            code: voucher,
            shipping_fee: this.selected,
            cart: this.cart,
          })
          .then((response) => {
            if (response.data.status == "success") {
              this.$refs.old_price.mess = response.data.mess;
              this.discount = response.data.data.price_discount;
            }
            this.$root.makeToast(response.data.status, response.data.mess);
          });
      } else {
        this.$root.makeToast("danger", "Bạn Chưa Nhập Mã Khuyến Mãi !");
      }
    },
    //Paypal checkout
    setLoaded: function () {
      this.loaded = true;
      window.paypal
        .Buttons({
          style: {
            shape: "rect",
            color: "blue",
            layout: "vertical",
            label: "checkout",
          },
          createOrder: (data, actions) => {
            if (this.$store.state.cart.length == 0) {
              return this.$root.makeToast("danger", "Giỏ hàng trống !");
            }
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
              purchase_units: [
                {
                  amount: {
                    currency_code: "USD",
                    value: this.total_paypal,
                  },
                },
              ],
            });
          },
          onApprove: (data, actions) => {
            // This function captures the funds from the transaction.
            return actions.order.capture().then((details) => {
              // This function shows a transaction success message to your buyer.
              axios
                .post("./paypal/store_order", {
                  order: details,
                  voucher: this.voucher,
                  shipping: this.selected,
                  cart: this.cart,
                  final_price: this.grandtotal,
                })
                .then((response) => {
                  if (response.data.status == "success") {
                    this.$root.makeToast(
                      response.data.status,
                      response.data.mess
                    );
                    this.$store.dispatch("clearCart");
                    return (window.location.href =
                      "./order-summary/order=" + response.data.order);
                  } else {
                    this.$root.makeToast(
                      response.data.status,
                      response.data.mess
                    );
                  }
                });
            });
          },
        })
        .render("#paypal-button-container");
    },
  },
  computed: {
    subtotal() {
      return (this.total_price = this.cart.reduce(
        (acc, item) => acc + item.price * item.quantity,
        0
      ));
    },
    total_paypal() {
      return (this.grandtotal * 0.0000433888).toFixed(2);
    },
    grandtotal() {
      return this.total_price + this.selected - this.discount;
    },
    old_price() {
      return this.total_price + this.selected;
    },
  },
  created() {
    this.shipping();
    this.get_list_item();
  },
};
</script>

<style>
</style>