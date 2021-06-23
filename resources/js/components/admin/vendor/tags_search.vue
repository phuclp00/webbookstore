<template>
  <div>
    <b-form-group
      label="Select Tags Available Here"
      label-for="tags-with-dropdown"
    >
      <b-form-tags
        id="tags-with-dropdown"
        v-model="value"
        no-outer-focus
        class="mb-2"
      >
        <template v-slot="{ tags, disabled, addTag, removeTag }">
          <ul v-if="tags.length > 0" class="list-inline d-inline-block mb-2">
            <li v-for="tag in tags" :key="tag" class="list-inline-item">
              <b-form-tag
                @remove="removeTag(tag)"
                :title="tag"
                :disabled="disabled"
                variant="info"
                >{{ tag }}</b-form-tag
              >
            </li>
          </ul>

          <b-dropdown
            size="sm"
            variant="outline-secondary"
            block
            menu-class="w-100"
          >
            <template #button-content>
              <b-icon icon="tag-fill"></b-icon> Choose tags
            </template>
            <b-dropdown-form @submit.stop.prevent="() => {}">
              <b-form-group
                label="Search tags"
                label-for="tag-search-input"
                label-cols-md="auto"
                class="mb-0"
                label-size="sm"
                :description="searchDesc"
                :disabled="disabled"
              >
                <b-form-input
                  v-model="search"
                  id="tag-search-input"
                  type="search"
                  size="sm"
                  autocomplete="off"
                ></b-form-input>
              </b-form-group>
            </b-dropdown-form>
            <b-dropdown-divider></b-dropdown-divider>
            <b-dropdown-item-button
              v-for="option in availableOptions"
              :key="option"
              @click="onOptionClick({ option, addTag })"
            >
              {{ option }}
            </b-dropdown-item-button>
            <b-dropdown-text v-if="availableOptions.length === 0">
              There are no tags available to select
            </b-dropdown-text>
          </b-dropdown>
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
      search: "",
      value: [],
    };
  },
  computed: {
    criteria() {
      // Compute the search criteria
      return this.search.trim().toLowerCase();
    },
    availableOptions() {
      const criteria = this.criteria;
      // Filter out already selected options
      const options = this.options.filter(
        (opt) => this.value.indexOf(opt) === -1
      );
      if (criteria) {
        // Show only options that match criteria
        return options.filter(
          (opt) => opt.toLowerCase().indexOf(criteria) > -1
        );
      }
      // Show all options available
      return options;
    },
    searchDesc() {
      if (this.criteria && this.availableOptions.length === 0) {
        return "There are no tags matching your search criteria";
      }
      return "";
    },
  },
  methods: {
    onOptionClick({ option, addTag }) {
      addTag(option);
      this.search = "";
    },
    get_list(type) {
      axios
        .get("/api/" + type)
        .then((response) => {
          this.options = response.data;
          console.log("Loading list " + type + " successfull !");
        })
        .catch((err) => {
          console.log(
            "Error while loading list " + type + " ! Check your connecting !"
          );
        });
    },
    get_id(type, id) {
      axios
        .get("/api/" + type + "/book/" + id)
        .then((response) => {
          response.data.forEach((index) => {
            this.value.push(index.name);
          });
          console.log("Loading " + type + " successfull !");
        })
        .catch((err) => {
          console.log(
            "Error while loading " + type + " ! Check your connecting !"
          );
        });
    },
  },
  created() {
    if (this.old_value) {
      this.get_id(this.type, this.old_value);
    }
    this.get_list(this.type);
  },
};
</script>