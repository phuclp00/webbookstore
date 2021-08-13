<template>
  <main class="cart-page-main-block inner-page-sec-padding-bottom">
    <div class="cart_area cart-area-padding">
      <div class="container">
        <div class="page-section-title">
          <h1>Shopping Cart</h1>
        </div>
        <div class="row">
          <div class="col-12">
            <form action="#" class="">
              <!-- Cart Table -->
              <div class="cart-table table-responsive mb--40">
                <table class="table">
                  <!-- Head Row -->
                  <thead>
                    <tr>
                      <th class="pro-remove"></th>
                      <th class="pro-thumbnail">Image</th>
                      <th class="pro-title">Product</th>
                      <th class="pro-price">Price</th>
                      <th class="pro-quantity">Quantity</th>
                      <th class="pro-subtotal">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Product Row -->
                    <tr v-for="(item, index) in cart" :key="index">
                      <td class="pro-remove">
                        <a @click="$store.commit('removeFromCart', index)"
                          ><i class="far fa-trash-alt"></i
                        ></a>
                      </td>
                      <td class="pro-thumbnail">
                        <a :href="'/shop/' + item.book_name"
                          ><img :src="'/' + item.img" alt="Product"
                        /></a>
                      </td>
                      <td class="pro-title">
                        <a :href="'/shop/' + item.book_name">{{
                          item.book_name
                        }}</a>
                      </td>
                      <td class="pro-price">
                        <span
                          >{{
                            item.price
                              | currency("đ", 0, {
                                symbolOnLeft: false,
                                spaceBetweenAmountAndSymbol: true,
                              })
                          }}
                        </span>
                      </td>
                      <td class="pro-quantity">
                        <div class="pro-qty">
                          <div class="count-input-block">
                            <input
                              type="number"
                              @change="update_cart()"
                              v-model="item.quantity"
                              class="form-control text-center"
                            />
                          </div>
                        </div>
                      </td>
                      <td class="pro-subtotal">
                        <span
                          >{{
                            itemtotal(item)
                              | currency("đ", 0, {
                                symbolOnLeft: false,
                                spaceBetweenAmountAndSymbol: true,
                              })
                          }}
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="cart-section-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-12 mb--30 mb-lg--0"></div>
          <!-- Cart Summary -->
          <div class="col-lg-6 col-12 d-flex">
            <div class="cart-summary">
              <div class="cart-summary-wrap">
                <h4><span>Tổng Tiền</span></h4>
                <h2>
                  Số tiền cần thanh toán:
                  <span class="text-primary"
                    >{{
                      grandtotal
                        | currency("đ", 0, {
                          symbolOnLeft: false,
                          spaceBetweenAmountAndSymbol: true,
                        })
                    }}
                  </span>
                </h2>
              </div>
              <div class="cart-summary-button">
                <a href="/checkout" class="checkout-btn c-btn btn--primary"
                  >Thanh Toán</a
                >
                <button
                  class="update-btn c-btn btn-outlined"
                  @click="$store.dispatch('clearCart')"
                >
                  Xóa Hết
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      check: true,
    };
  },
  methods: {
    itemtotal(item) {
      return item.quantity * item.price;
    },
    update_cart() {
      this.cart.forEach((data, key) => {
        if (data.quantity < 1) {
          this.check = false;
          return this.$store.commit("removeFromCart", key);
        }
      });
      if (this.check) {
        axios
          .post("/api/checkout/check-quantity", { cart: this.cart })
          .then((response) => {
            if (response.data.status == "success") {
              return this.$store.commit("updateCart", this.cart);
            } else
              return this.$root.makeToast(
                response.data.status,
                response.data.mess
              );
          });
      }
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
  },
  computed: {
    cart() {
      return this.$store.state.cart;
    },
    grandtotal() {
      return this.$store.state.cart.reduce(
        (acc, item) => acc + item.price * item.quantity,
        0
      );
    },
  },
  beforeCreate() {},
};
</script>

<style>
</style>