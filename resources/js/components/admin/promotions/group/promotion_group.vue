<template>
  <div>
    <b-button v-b-toggle.collapse-1 variant="primary"
      >Adding promotions to books</b-button
    >
    <b-collapse id="collapse-1" class="mt-3">
      <b-card
        header="*Note : Adding 1 type of promotion can change the current promotion of that product"
        header-class="text-white"
        header-bg-variant="warning"
        title="Add Promotions to Books"
      >
        <b-row>
          <b-col>
            <b-form-group label="Select Type Of Promotions">
              <b-form-radio-group
                id="radio-slots"
                v-model="selected"
                :options="options"
                :checked="change()"
                name="radio-options-slots"
              >
              </b-form-radio-group>
            </b-form-group>
            <b-form-group>
              <input-tags :type="selected" :ref="selected"></input-tags>
              <select-options
                type="promotions"
                ref="promotions"
              ></select-options>
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
      selected: "",
      data: [],
      options: [
        { text: "Books", value: "books" },
        { text: "Category", value: "category" },
        { text: "Author", value: "author" },
      ],
    };
  },
  methods: {
    get_options(otions) {
      switch (otions) {
        case "books":
          return this.$refs.books.value;
        case "category":
          return this.$refs.category.value;
        case "author":
          return this.$refs.author.value;
        default:
          break;
      }
    },
    change() {
      if (this.selected) {
        if (this.$refs.books) {
          this.$refs.books.value = [];
        } else if (this.$refs.category) {
          this.$refs.category.value = [];
        } else if (this.$refs.author) {
          this.$refs.author.value = [];
        }
      }
    },
    submit() {
      let books = this.get_options(this.selected);
      let promotions = this.$refs.promotions.selected;
      if (this.selected == "") {
        return this.makeToast("danger", "Select Type Promotions Is Required");
      }
      if (books.length == 0) {
        return this.makeToast(
          "danger",
          "Select Type " + this.selected + " Is Required"
        );
      } else if (promotions.length == 0) {
        return this.makeToast("danger", "Select Promotions Is Required");
      } else {
        axios
          .post("/admin/promotions/option/books-multiple", {
            type: this.selected + ": " + books,
            promotions: promotions,
          })
          .then((response) => {
            this.makeToast(response.data.status, response.data.mess);
            this.change();
            this.data = response.data.result;
          });
      }
    },
    makeToast(variant, mess) {
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