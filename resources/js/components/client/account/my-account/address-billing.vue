<template>
  <div class="myaccount-content">
    <h3>Địa Chỉ Giao Hàng</h3>
    <b-form-group label="Danh Sách Địa Chỉ Của Tôi">
      <b-form-radio
        v-for="(address, key) in address_list"
        v-model="selected"
        :key="key"
        :value="address.id"
        @change="apply_address(selected)"
        name="address-list"
      >
        Địa chỉ số {{ ++key }}
      </b-form-radio>
      <address class="h2 font-weight-bold">
        {{ address }}
      </address>
      <b-card bg-variant="light">
        <!-- City -->
        <b-form-group label="Tỉnh/ Thành:" label-for="city">
          <b-form-select
            id="city"
            v-model="city"
            :options="city_list"
            @change="get_districts(city)"
          ></b-form-select>
        </b-form-group>
        <!-- District -->
        <b-form-group label="Quận/ Huyện:" label-for="district">
          <b-form-select
            id="district"
            v-model="district"
            :options="district_list"
            :disabled="city.length == 0"
            @change="get_wards_list(district)"
          ></b-form-select>
        </b-form-group>
        <!-- Wards -->
        <b-form-group label="Phường/ Xã:" label-for="wards">
          <b-form-select
            id="wards"
            v-model="wards"
            :options="wards_list"
            :disabled="district.length == 0"
          ></b-form-select>
        </b-form-group>
        <!-- Street -->
        <b-form-group label="Địa chỉ:" label-for="address_line_1">
          <b-form-input
            id="address_line_1"
            v-model="address_line_1"
            trim
          ></b-form-input>
          <b-form-input
            id="address_line_2"
            placeholder="Bạn có thể bỏ qua trường này nếu cần thiết"
            v-model="address_line_2"
            trim
          ></b-form-input>
        </b-form-group>

        <!-- Zip code -->
        <b-form-group label="Mã Bưu Điện/ Zip code:" label-for="zipcode">
          <b-form-input
            type="number"
            id="zipcode"
            v-model="zipcode"
          ></b-form-input>
        </b-form-group>
      </b-card>
    </b-form-group>
    <button
      class="btn btn--primary"
      style="margin-right: 20px"
      @click="edit(selected)"
    >
      <i class="fa fa-edit"></i>Chỉnh Sửa Địa Chỉ Này</button
    ><button class="btn btn-warning" @click="add()">
      <i class="fa fa-edit"></i>Thêm Địa Chỉ
    </button>
    <button class="btn btn-danger" @click="remove(selected)">
      Xóa Địa Chỉ Này
    </button>
  </div>
</template>
<script>
export default {
  props: ["user"],
  data() {
    return {
      city_list: [],
      wards_list: [],
      district_list: [],
      address_line_1: "",
      address_line_2: "",
      wards: "",
      district: "",
      city: "",
      zipcode: 0,
      selected: "",
      wards_check: true,
      district_check: true,
      address: "",
      address_list: [],
    };
  },

  methods: {
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
    get_districts(code) {
      this.district_list = [];
      axios.get("/api/districts-" + code).then((response) => {
        response.data.forEach((districts) => {
          return this.district_list.push({
            value: districts.code,
            text: districts.name,
          });
        });
      });
    },
    get_wards_list(code) {
      this.wards_list = [];
      axios.get("/api/wards-" + code).then((response) => {
        response.data.forEach((wards) => {
          return this.wards_list.push({
            value: wards.code,
            text: wards.name,
          });
        });
      });
    },
    apply_address(address) {
      let address_selected = this.address_list.find(
        (data) => data.id == address
      );
      console.log(address_selected);
      this.address_line_1 = "";
      this.address_line_2 = "";
      this.wards = "";
      this.district = "";
      this.city = "";
      this.zipcode = "";
      return (this.address =
        (address_selected.address_line_1 == null
          ? ""
          : "Địa chỉ cụ thể: " + address_selected.address_line_1) +
        ", " +
        (address_selected.address_line_2 == null
          ? ""
          : " " + address_selected.address_line_2 + ", ") +
        (address_selected.get_wards == null
          ? address_selected.wards == null
            ? ""
            : "Phường/xã: " + address_selected.wards + ", "
          : "Phường/xã: " + address_selected.get_wards.name + ", ") +
        (address_selected.get_districts == null
          ? "Quận/huyện: " + address_selected.district
          : "Quận/huyện: " + address_selected.get_districts.name) +
        ",  " +
        (address_selected.get_city == null
          ? "Thành phố/tỉnh: " + address_selected.city
          : "Thành phố/tỉnh: " + address_selected.get_city.name) +
        ", " +
        "Mã bưu chính: " +
        address_selected.zip_code);
    },
    check() {
      if (
        this.address_line_1 == "" ||
        this.wards == "" ||
        this.district == "" ||
        this.city == ""
      ) {
        return this.$root.makeToast(
          "danger",
          "Các trường dữ liệu không được để trống"
        );
      }
      if (this.zipcode <= 0) {
        return this.$root.makeToast("danger", "Zipcode không được nhỏ hơn 0");
      }

      return true;
    },
    edit(id) {
      if (this.selected == "") {
        return this.$root.makeToast(
          "danger",
          "Chọn địa chỉ để áp dụng thay đổi !"
        );
      }
      if (this.check() == true) {
        axios
          .post("/my-account/address-update", {
            id: id,
            address_line_1: this.address_line_1,
            address_line_2: this.address_line_2,
            wards: this.wards,
            district: this.district,
            city: this.city,
            zipcode: this.zipcode,
          })
          .then((response) => {
            if (response.data.status == "success") {
              this.address_list = response.data.data;
              this.address = "";
            }
            Vue.nextTick(() => {
              return this.$root.makeToast(
                response.data.status,
                response.data.mess
              );
            });
          });
      }
    },
    add() {
      if (this.check() == true) {
        axios
          .post("/my-account/address-add", {
            address_line_1: this.address_line_1,
            address_line_2: this.address_line_2,
            wards: this.wards,
            district: this.district,
            city: this.city,
            zipcode: this.zipcode,
          })
          .then((response) => {
            if (response.data.status == "success") {
              this.address_list = response.data.data;
              this.address = "";
            }
            Vue.nextTick(() => {
              return this.$root.makeToast(
                response.data.status,
                response.data.mess
              );
            });
          });
      }
    },
    remove(id) {
      if (this.selected == "") {
        return this.$root.makeToast(
          "danger",
          "Chọn địa chỉ để áp dụng thay đổi !"
        );
      }
      axios
        .post("/my-account/address-remove", {
          id: id,
        })
        .then((response) => {
          if (response.data.status == "success") {
            this.address_list = response.data.data;
            this.address = "";
          }
          Vue.nextTick(() => {
            return this.$root.makeToast(
              response.data.status,
              response.data.mess
            );
          });
        });
    },
  },
  created() {
    this.get_cities();
    this.address_list = this.user.address;
  },
};
</script>

<style>
</style>