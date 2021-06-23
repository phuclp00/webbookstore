
<template>
  <div>
    <b-form-group
      :label="'Select ' + this.type"
      class="capitalize"
      :label-for="this.type"
    >
      <b-form-select
        :id="this.type"
        :name="this.type"
        v-model="selected"
        :options="options"
        :disabled="disabled"
        class="mb-2"
      >
        <template #first>
          <b-form-select-option :value="null" disabled
            >Please select an option promotions types....
          </b-form-select-option>
        </template>
      </b-form-select>
    </b-form-group>
  </div>
</template>

<script>
export default {
  props: ["type", "old_value", "status"],
  data() {
    return {
      selected: null,
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
};
</script>
<style scoped>
.capitalize {
  text-transform: capitalize;
}
</style>