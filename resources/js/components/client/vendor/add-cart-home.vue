<template>
  <a href="javascript:void(0)" @click="addToCart()" class="single-btn">
    <i class="fas fa-shopping-basket"></i>
  </a>
</template>

<script>
export default {
  props: ["product"],
  data() {
    return {
      item: {
        book_name: "",
        book_id: "",
        price: "",
        img: "",
        quantity: 1,
      },
    };
  },
  methods: {
    addToCart() {
      let book = this.$store.state.cart.filter(
        (data) => data.book_id == this.item.book_id
      );
      var quantity_check =
        book.length > 0
          ? parseInt(this.item.quantity) + parseInt(book[0].quantity)
          : 1;
      axios
        .post("/api/book/check-quantity", {
          quantity: quantity_check,
          book: this.item.book_id,
        })
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          if (response.data.status == "success") {
            this.$emit("addToCart", this.item);
            return this.$store.commit("addToCart", this.item);
          }
        });
    },
  },
  created() {
    this.item.book_name = this.product.book_name;
    this.item.book_id = this.product.book_id;
    this.item.price =
      this.product.promotion == null
        ? this.product.price
        : this.product.price -
          this.product.price * (this.product.promotion.percent / 100);
    this.item.img = this.product.img;
  },
};
</script>

<style>
</style>