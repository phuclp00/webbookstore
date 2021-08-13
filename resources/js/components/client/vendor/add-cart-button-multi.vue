<template>
  <a href="javascript:void(0)" @click="addToCart()" class="btn btn-outlined"
    >Thêm Vào Giỏ Hàng</a
  >
</template>
<script>
export default {
  props: ["product", "quantity"],
  data() {
    return {
      item: {
        book_name: "",
        book_id: "",
        price: "",
        img: "",
      },
    };
  },
  methods: {
    addToCart() {
      if (this.quantity > 0) {
        let book = this.$store.state.cart.filter(
          (data) => data.book_id == this.item.book_id
        );

        var quantity_check =
          book.length > 0
            ? parseInt(this.quantity) + parseInt(book[0].quantity)
            : 1;

        axios
          .post("/api/book/check-quantity", {
            quantity: quantity_check,
            book: this.product.book_id,
          })
          .then((response) => {
            this.$root.makeToast(response.data.status, response.data.mess);
            if (response.data.status == "success") {
              this.$store.commit("addToCartMulti", {
                product: this.product,
                total: parseInt(this.quantity),
              });
            }
          });
      } else {
        return this.$root.makeToast(
          "danger",
          "Bạn cần chọn số lượng lớn hơn 0 !"
        );
      }
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