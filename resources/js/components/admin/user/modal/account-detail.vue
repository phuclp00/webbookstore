<template>
  <div class="row">
    <div class="col-12 mb--20">
      <label>Full Name:</label>
      <b-form-input v-model="fullname" type="text" trim></b-form-input>
    </div>
    <div class="col-12 mb--20">
      <label>City:</label>
      <b-form-select v-model="city" :options="city_list" trim></b-form-select>
    </div>
    <div class="col-12 mb--20">
      <label>District</label>
      <b-form-select
        id="district"
        v-model="district"
        :options="districts"
        trim
      ></b-form-select>
    </div>
    <div class="col-12 mb--20">
      <label>Wards</label>
      <b-form-select v-model="wards" :options="wards_list" trim></b-form-select>
    </div>
    <!-- Địa Chỉ Chi Tiết -->
    <div class="col-12 mb--20">
      <label>Address </label>
      <b-form-input type="text" v-model="address_line_1" trim></b-form-input>
      <b-form-input type="text" v-model="address_line_2" trim></b-form-input>
    </div>
    <!-- Mã Bưu Chính -->
    <div class="col-md-6 col-12 mb--20">
      <label for="zipcode">Zip Code:</label>
      <b-form-input
        id="zipcode"
        type="number"
        v-model="zipcode"
        trim
      ></b-form-input>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      selected: "",
      fullname: this.user.user_name,
      email: this.user.email,
      phone: this.user.phone,
      address_line_1: "",
      address_line_2: "",
      wards: "",
      district: this.user.address.district,
      city: this.user.address.city,
      country: this.user.address.country,
      zipcode: this.user.address.zipcode,
      status: "not_accepted",
      wards_list: [],
      districts: [],
      city_list: [],
    };
  },
  methods: {
    get_wards() {
      axios.get("/api/wards-" + this.districts).then((response) => {
        response.data.forEach((wards) => {
          return this.wards_list.push({
            value: wards.code,
            text: wards.name,
          });
        });
      });
    },
    get_districts() {
      axios.get("/api/districts-" + this.city).then((response) => {
        response.data.forEach((districts) => {
          return this.districts.push({
            value: districts.code,
            text: districts.name,
          });
        });
      });
    },
    get_cities() {
      axios.get("/api/city-list").then((response) => {
        response.data.forEach((city) => {
          return this.city_list.push({
            value: city.code,
            text: city.name,
          });
        });
      });
    },
  },
  created() {
    this.get_wards();
    this.get_districts();
    this.get_cities();
  },
};
</script>

<style>
</style>