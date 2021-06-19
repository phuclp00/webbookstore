<template>
  <div>
    <b-form-group
      :label="'Select Book ' + this.type"
      id="capitalize"
      label-for="tags-component-select"
    >
      <!-- Prop `add-on-change` is needed to enable adding tags vie the `change` event -->
      <b-form-tags
        input-id="tags-component-select"
        v-model="value"
        size="lg"
        class="mb-2"
        :name="this.type + '[]'"
        add-on-change
        no-outer-focus
      >
        <template
          v-slot="{ tags, inputAttrs, inputHandlers, disabled, removeTag }"
        >
          <ul v-if="tags.length > 0" class="list-inline d-inline-block mb-3">
            <li v-for="tag in tags" :key="tag" class="list-inline-item">
              <b-form-tag
                @remove="removeTag(tag)"
                :title="tag"
                :disabled="disabled"
                size="lg"
                variant="primary"
                >{{ tag }}</b-form-tag
              >
            </li>
          </ul>
          <b-form-select
            v-bind="inputAttrs"
            v-on="inputHandlers"
            :disabled="disabled || availableOptions.length === 0"
            :options="availableOptions"
          >
            <template #first>
              <!-- This is required to prevent bugs with Safari -->
              <option disabled value="">Choose a {{ type }}...</option>
            </template>
          </b-form-select>
        </template>
      </b-form-tags>
    </b-form-group>
  </div>
</template>

<script>
export default {
  props: ["type", "old_value"],
  data() {
    return {
      options: [],
      value: [],
    };
  },
  computed: {
    availableOptions() {
      return this.options.filter((opt) => this.value.indexOf(opt) === -1);
    },
  },
  methods: {
    get_category() {
      axios
        .get("/api/category")
        .then((response) => {
          this.options = response.data;
          console.log("Loading list category successfull !");
        })
        .catch((err) => {
          console.log(
            "Error while loading list category ! Check your connecting !"
          );
        });
    },
    get_tags() {},
    // Optional : Author
    get_list_author() {
      axios
        .get("/api/author")
        .then((response) => {
          this.options = response.data;
          console.log("Loading list author successfull !");
        })
        .catch((err) => {
          console.log(
            "Error while loading list author ! Check your connecting !"
          );
        });
    },
    get_author(id) {
      axios
        .get("/api/author/book/" + id)
        .then((response) => {
          response.data.forEach((index) => {
            this.value.push(index.name);
          });
          console.log("Loading author successfull !");
        })
        .catch((err) => {
          console.log("Error while loading author ! Check your connecting !");
        });
    },
  },
  created() {
    switch (this.type) {
      case "category":
        this.get_category();
        break;
      case "tags":
        this.get_tags();
      case "author":
        if (this.old_value != "") {
          this.get_author(this.old_value);
        }
        this.get_list_author();
      default:
        break;
    }
  },
};
</script>
<style scoped>
#capitalize {
  text-transform: capitalize;
}
</style>