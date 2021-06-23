<template>
  <div>
    <b-button v-b-toggle.collapse-1 variant="primary"
      >Adding tagging to books</b-button
    >
    <b-collapse id="collapse-1" class="mt-3">
      <b-card header="Multiple Tags" title="Add Multiple Tags to Books">
        <b-row>
          <b-col>
            <input-tags type="books" ref="books"></input-tags>

            <input-tags-search type="tags" ref="tags"></input-tags-search>
            <b-form-group>
              <b-button
                size="lg"
                v-on:click="submit()"
                variant="outline-primary"
                >OK</b-button
              >
            </b-form-group>
          </b-col>
        </b-row>
      </b-card>
    </b-collapse>
  </div>
</template>
<script>
export default {
  data() {
    return {
      book: [],
      tags: [],
      data: [],
    };
  },
  watch: {},
  methods: {
    submit() {
      let books = this.$refs.books.value;
      let tags = this.$refs.tags.value;
      if (books.length == 0) {
        this.makeToast("danger", "Select Books Is Required");
      } else if (tags.length == 0) {
        this.makeToast("danger", "Select Tags Is Required");
      } else {
        axios
          .post("./tags/option/books-multiple", { books: books, tags: tags })
          .then((response) => {
            this.makeToast(response.data.status, response.data.mess);
            this.$refs.books.value = [];
            this.$refs.tags.value = [];
            this.data = response.data.result;
          });
      }
    },
    makeToast(variant = null, mess) {
      this.$bvToast.toast(mess, {
        title: "Messege feeback :",
        variant: variant,
        solid: true,
      });
    },
  },
};
</script>
<style>
</style>