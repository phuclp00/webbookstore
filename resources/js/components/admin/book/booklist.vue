
<template>
  <div class="iq-card-body">
    <div class="table-responsive">
      <booklistdata :books="this.books" :router="this.router"></booklistdata>
    </div>
  </div>
</template>
<script>
import booklistdata from "./datatable/book.vue";
export default {
  components: { booklistdata },
  props: ["books", "router"],
  data() {
    return {};
  },
};
</script>
<style>
.buttons-html5 {
  background-color: var(--iq-white);
}
table {
  text-align: center;
}
</style>