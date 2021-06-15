<template>
  <div class="form-group">
    <label for="date-input">Date Published: </label>
    <b-input-group class="mb-3">
      <b-form-input
        id="date-input"
        v-model="value"
        type="text"
        placeholder="YYYY-MM-DD"
        autocomplete="off"
        name="date_published"
      ></b-form-input>
      <b-input-group-append>
        <b-form-datepicker
          v-model="value"
          button-only
          right
          locale="en-US"
          aria-controls="date-input"
          @context="onContext"
        ></b-form-datepicker>
      </b-input-group-append>
    </b-input-group>
  </div>
</template>

<script>
export default {
  props: ["date_published"],
  data() {
    return {
      value: this.date_published == null ? "" : this.date_published,
    };
  },
  methods: {
    onContext(ctx) {
      // The date formatted in the locale, or the `label-no-date-selected` string
      this.formatted = ctx.selectedFormatted;
      // The following will be an empty string until a valid date is entered
      this.selected = ctx.selectedYMD;
    },
  },
};
</script>