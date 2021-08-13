<template>
 
</template>
<script>
import cart from "../vendor/add-cart-home.vue";
export default {
  components: { cart },
  props: ["id"],
  data() {
    return {
      books: [],
    };
  },
  methods: {
    get_related_product() {
      axios.get("/api/product/related/" + this.id).then((response) => {
        if (response.data.status == "success") {
          return (this.books = response.data.data);
        } else {
          return this.$root.makeToast(response.data.status, response.data.mess);
        }
      });
    },
    truncate: function (text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
    },
    sendEventClick(item) {},
  },
  created() {
    this.get_related_product();
  },
};
</script>

<style>
</style>