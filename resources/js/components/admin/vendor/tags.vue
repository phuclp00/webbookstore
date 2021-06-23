
<template>
  <div>
    <b-form-checkbox
      v-if="this.type == 'translator'"
      switch
      size="lg"
      v-model="disabled"
      class="capitalize"
      >Disable {{ this.type }}</b-form-checkbox
    >
    <b-form-group
      :label="'Select ' + this.type"
      class="capitalize"
      label-for="tags-component-select"
    >
      <!-- Prop `add-on-change` is needed to enable adding tags vie the `change` event -->
      <b-form-tags
        input-id="tags-component-select"
        v-model="value"
        size="lg"
        class="mb-2"
        :disabled="disabled"
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
import { remove } from "lodash";
export default {
  props: ["type", "old_value", "status"],
  data() {
    return {
      options: [],
      disabled: false,
      value: [],
    };
  },
  computed: {
    availableOptions() {
      return this.options.filter((opt) => this.value.indexOf(opt) === -1);
    },
  },
  methods: {
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
    this.disabled = this.status == 1 ? true : false;
    this.get_list(this.type);
  },
  updated() {
    this.get_list(this.type);
  },
};
</script>
<style scoped>
.capitalize {
  text-transform: capitalize;
}
</style>