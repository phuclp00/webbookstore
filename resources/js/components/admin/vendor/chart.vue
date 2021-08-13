<template>
  <div>
    <div class="form-group col-sm-5">
      <label for="exampleInputmonth">Select Month</label>
      <input
        type="month"
        class="form-control"
        v-model="month"
        id="exampleInputmonth"
        @change="get_chart_date(month)"
      />
    </div>
    <apexchart
      height="500px"
      type="bar"
      :options="options"
      :series="series"
    ></apexchart>
    <apexchart
      type="line"
      height="500px"
      :options="options"
      :series="series"
    ></apexchart>
  </div>
</template>

<script>
import moment, { now } from "moment";
export default {
  data() {
    return {
      month: moment().format("YYYY-MM"),
      options: {
        xaxis: {
          categories: [],
        },
      },
      series: [
        {
          name: "Total Sales (vnd)",
          data: [],
        },
      ],
    };
  },
  mounted() {
    this.get_chart_date();
  },
  methods: {
    get_chart_date() {
      axios.get("/admin/chart/" + this.month).then((response) => {
        this.$root.makeToast(response.data.status, response.data.mess);
        this.series = [
          {
            data: response.data.data,
          },
        ];
        this.options = {
          xaxis: {
            categories: response.data.date,
          },
        };
      });
    },
  },
};
</script>

<style>
</style>