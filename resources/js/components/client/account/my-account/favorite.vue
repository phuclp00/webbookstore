<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Danh Sách Yêu Thích Của Tôi</h2>
      </div>
      <div class="col-12">
        <!-- Cart Table -->
        <div class="cart-table table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th class="pro-thumbnail">Hình Ảnh</th>
                <th class="pro-title">Tên Sản Phẩm</th>
                <th class="pro-price">Giá</th>
                <th class="pro-remove">Xóa</th>
              </tr>
            </thead>
            <tbody class="m-n1">
              <tr v-for="book in wishlist" :key="book.book_id">
                <td class="pro-thumbnail">
                  <a :href="'/shop/' + book.book_name"
                    ><img :src="'/' + book.img" :alt="book.book_name"
                  /></a>
                </td>
                <td class="pro-title">
                  <a :href="'/shop/' + book.book_name">{{ book.book_name }} </a>
                </td>
                <td class="pro-price">
                  <span>{{
                    book.price
                      | currency("đ", 0, {
                        symbolOnLeft: false,
                        spaceBetweenAmountAndSymbol: true,
                      })
                  }}</span>
                </td>
                <td class="pro-remove">
                  <a href="javascript:void(0)" @click="remove(book)"
                    ><i class="far fa-trash-alt"></i
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col">
        <button
          style="float: right"
          class="btn btn-outline-danger"
          @click="save()"
        >
          Lưu Danh Sách
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      wishlist: [],
    };
  },
  methods: {
    get_wishlist() {
      axios.get("/my-account/favorite/show").then((response) => {
        this.$root.makeToast(response.data.status, response.data.mess);
        if (response.data.status == "success") {
          return (this.wishlist = response.data.data);
        }
      });
    },
    remove(item) {
      let filter = this.wishlist.filter((data) => {
        return data.book_id != item.book_id;
      });
      return (this.wishlist = filter);
    },
    save() {
      axios
        .post("/my-account/favorite/sync", { item: this.wishlist })
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          if (response.data.status == "success") {
            return (this.wishlist = response.data.data);
          }
        });
    },
  },
  mounted() {
    this.get_wishlist();
  },
};
</script>

<style>
</style>