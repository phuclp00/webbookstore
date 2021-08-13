<template>
  <div class="cart-block">
    <div class="cart-total">
      <span class="text-number" v-text="cart.length"> </span>
      <span class="text-item"> Shopping Cart </span>
      <span class="price">
        <i class="fas fa-chevron-down"></i>
      </span>
    </div>
    <div class="cart-dropdown-block">
      <div class="single-cart-block">
        <div class="cart-product" v-for="item in cart" :key="item.book_id">
          <a :href="'/shop/' + item.book_name" class="image">
            <img :src="'/' + item.img" :alt="item.book_name" />
          </a>
          <div class="content">
            <h3 class="title">
              <a :href="'/shop/' + item.book_name">{{ item.book_name }}</a>
            </h3>
            <p class="price">
              <span class="qty">{{ item.quantity }} ×</span>
              {{
                item.price
                  | currency("đ", 0, {
                    symbolOnLeft: false,
                    spaceBetweenAmountAndSymbol: true,
                  })
              }}
            </p>
            <button
              class="cross-btn"
              @click="$store.commit('removeFromCart', item)"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="single-cart-block">
        <div class="btn-block">
          <a href="/my-shopping-cart" class="btn"
            >View Cart <i class="fas fa-chevron-right"></i
          ></a>
          <a href="/checkout" class="btn btn--primary"
            >Check Out <i class="fas fa-chevron-right"></i
          ></a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    cart() {
      return this.$store.state.cart;
    },
  },
};
</script>

<style>
</style>