<template>
  <div>
    <div id="billing-form" class="mb-40">
      <h4 class="checkout-title">Thông Tin Đặt Hàng</h4>
      <h5 class="checkout-title" v-if="show != ''">
        {{ show }} <br />
        Sđt mặc định : {{ phone ? phone : "Chưa có sđt" }}
      </h5>
      <div v-if="user_address != null">
        <b-form-group
          label="Danh Sách Địa Chỉ Của Tôi"
          v-slot="{ ariaDescribedby }"
        >
          <b-form-checkbox
            v-for="(address, key) in addressList"
            v-model="selected"
            :key="key"
            :value="address.id"
            :aria-describedby="ariaDescribedby"
            @change="apply_address(selected)"
            name="address-list"
          >
            Địa chỉ số {{ key }}
          </b-form-checkbox>
        </b-form-group>
      </div>
      <div class="row" v-show="selected == false">
        <!-- Họ và Tên -->
        <div class="col-12 mb--20" v-if="user_address == null">
          <label for="fullname">Họ và Tên:</label>
          <b-form-input
            id="fullname"
            v-model="fullname"
            type="text"
            :state="nameState"
            aria-describedby="input-fullname-live-feedback"
            placeholder="Họ và Tên"
            trim
          ></b-form-input>
          <!-- This will only be shown if the preceding input has an invalid state -->
          <b-form-invalid-feedback id="input-provinces-live-feedback">
            Vui Lòng Nhập Họ và Tên
          </b-form-invalid-feedback>
        </div>
        <!-- Tỉnh -->
        <div class="col-12 mb--20">
          <label for="city">Tỉnh/Thành Phố:</label>
          <b-form-select
            id="city"
            v-model="city"
            :state="cityState"
            :options="city_list"
            aria-describedby="input-city-live-feedback"
            placeholder="Tỉnh/Thành"
            @change="get_districts(city)"
            trim
          ></b-form-select>
          <b-form-invalid-feedback id="input-fullname-live-feedback">
            Chọn Tỉnh/Thành
          </b-form-invalid-feedback>
        </div>
        <!-- Huyện -->
        <div class="col-12 mb--20">
          <label for="city">Quận/Huyện:</label>
          <b-form-select
            id="district"
            v-model="district"
            :state="districtState"
            :options="districts"
            :disabled="city.length == 0"
            aria-describedby="input-districts-live-feedback"
            placeholder="Quận/Huyện"
            @change="get_wards_list(district)"
            trim
          ></b-form-select>
          <!-- This will only be shown if the preceding input has an invalid state -->
          <b-form-invalid-feedback id="input-districts-live-feedback">
            Chọn Quận/Huyện
          </b-form-invalid-feedback>
        </div>
        <!-- Xã -->
        <div class="col-12 mb--20">
          <label for="city">Phường/Xã:</label>
          <b-form-select
            id="wards"
            v-model="wards"
            :state="wardsState"
            :options="wards_list"
            :disabled="district.length == 0"
            aria-describedby="input-wards-live-feedback"
            placeholder="Quận/Huyện"
            trim
          ></b-form-select>
          <!-- This will only be shown if the preceding input has an invalid state -->
          <b-form-invalid-feedback id="input-wards-live-feedback">
            Chọn Phường/Xã
          </b-form-invalid-feedback>
        </div>
        <!-- Email -->
        <div class="col-md-6 col-12 mb--20" v-if="user_address == null">
          <label for="email">Email:</label>
          <b-form-input
            id="email"
            type="email"
            v-model="email"
            :state="emailState"
            aria-describedby="input-email-live-feedback"
            placeholder="Địa chỉ email"
            trim
          ></b-form-input>
          <!-- This will only be shown if the preceding input has an invalid state -->
          <b-form-invalid-feedback id="input-email-live-feedback">
            Nhập địa chỉ email
          </b-form-invalid-feedback>
        </div>
        <!-- Số điện thoại -->
        <div class="col-md-6 col-12 mb--20" v-if="user_address == null">
          <label for="phone">Số điện thoại:</label>
          <b-form-input
            id="phone"
            type="tel"
            v-model="phone"
            :state="phoneState"
            aria-describedby="input-phone-live-feedback"
            placeholder="Số điện thoại"
            trim
          ></b-form-input>
          <!-- This will only be shown if the preceding input has an invalid state -->
          <b-form-invalid-feedback id="input-phone-live-feedback">
            Nhập số điện thoại
          </b-form-invalid-feedback>
        </div>
        <!-- Địa Chỉ Chi Tiết -->
        <div class="col-12 mb--20">
          <label for="address_line_1">Địa Chỉ Chi Tiết:</label>
          <b-form-input
            id="address_line_1"
            type="text"
            v-model="address_line_1"
            :state="address_line_1State"
            aria-describedby="input-address_line_1-live-feedback"
            placeholder="Địa Chỉ Chi Tiết..."
            trim
          ></b-form-input>
          <b-form-invalid-feedback id="input-address_line_1-live-feedback">
            Địa chỉ chi tiết ....
          </b-form-invalid-feedback>
          <b-form-input
            id="address_line_2"
            type="text"
            v-model="address_line_2"
            :state="address_line_2State"
            aria-describedby="input-address_line_2-live-feedback"
            placeholder="Địa Chỉ Chi Tiết ..."
            trim
          ></b-form-input>
          <b-form-invalid-feedback id="input-address_line_2-live-feedback">
            Địa chỉ chi tiết ....
          </b-form-invalid-feedback>
        </div>
        <!-- Mã Bưu Chính -->
        <div class="col-md-6 col-12 mb--20">
          <label for="phone">Mã Bưu Chính/Zip Code:</label>
          <b-form-input
            id="zipcode"
            type="number"
            v-model="zipcode"
            :state="zipcodeState"
            aria-describedby="input-zipcode-live-feedback"
            placeholder="Mã Bưu Chính/Zip Code"
            trim
          ></b-form-input>
          <!-- This will only be shown if the preceding input has an invalid state -->
          <b-form-invalid-feedback id="input-zipcode-live-feedback">
            Nhập Mã Bưu Chính/Zip Code
          </b-form-invalid-feedback>
        </div>
        <!-- Create Account -->
        <div class="col-12 mb--20" v-if="user_address == null">
          <div class="block-border check-bx-wrapper">
            <b-form-checkbox
              id="checkbox-account"
              v-model="createAccount"
              name="checkbox-account"
              value="true"
              unchecked-value="false"
            >
              Tạo tài khoản cho tôi từ những thông tin trên
            </b-form-checkbox>
          </div>
        </div>
      </div>
    </div>
    <div class="order-note-block mt--30">
      <label for="order-note">Ghi Chú Cho Đơn Hàng :</label>
      <b-form-textarea
        id="order-note"
        v-model="note"
        cols="30"
        rows="10"
        class="order-note"
        placeholder="Ghi chú thêm cho người vận chuyển..."
      ></b-form-textarea>
    </div>
    <div class="term-block">
      <b-form-checkbox
        id="checkbox-1"
        v-model="status"
        name="checkbox-1"
        value="accepted"
        unchecked-value="not_accepted"
      >
        Tôi đã đọc và đồng ý với các điều khoản, chính sách của cửa hàng
      </b-form-checkbox>
    </div>
    <button class="place-order w-100" @click="submit()">Đặt Hàng</button>
  </div>
</template>

<script>
export default {
  props: ["user_address"],
  data() {
    return {
      selected: "",
      fullname: "",
      email: "",
      phone: "",
      address_line_1: "",
      address_line_2: "",
      wards: "",
      district: "",
      city: "",
      country: "",
      zipcode: "",
      note: "",
      createAccount: false,
      status: "not_accepted",
      city_list: [],
      districts: [],
      wards_list: [],
      addressList: [],
      hidden: false,
      show: "",
    };
  },
  methods: {
    get_cities() {
      axios.get("./api/city-list").then((response) => {
        response.data.forEach((city) => {
          return this.city_list.push({
            value: city.code,
            text: city.name,
          });
        });
      });
    },
    get_districts(code) {
      this.districts = [];
      axios.get("./api/districts-" + code).then((response) => {
        response.data.forEach((districts) => {
          return this.districts.push({
            value: districts.code,
            text: districts.name,
          });
        });
      });
    },
    get_wards_list(code) {
      this.wards_list = [];
      axios.get("./api/wards-" + code).then((response) => {
        response.data.forEach((wards) => {
          return this.wards_list.push({
            value: wards.code,
            text: wards.name,
          });
        });
      });
    },
    submit() {
      if (this.nameState == false) {
        return this.$root.makeToast("danger", "Kiểm tra lại Họ và Tên !");
      }
      if (this.cityState == false) {
        return this.$root.makeToast("danger", "Kiểm tra lại Tỉnh/Thành Phố!");
      }
      if (this.districtState == false) {
        return this.$root.makeToast("danger", "Kiểm tra lại Quận/Huyện!");
      }
      if (this.wardsState == false) {
        return this.$root.makeToast("danger", "Kiểm tra lại Phường/Xã!");
      }
      if (this.emailState == false) {
        return this.$root.makeToast("danger", "Kiểm tra lại email !");
      }
      if (this.phoneState == false) {
        return this.$root.makeToast("danger", "Kiểm tra lại Số điện thoại!");
      }
      if (this.address_line_1State == false) {
        return this.$root.makeToast("danger", "Kiểm tra lại Địa chỉ chi tiết!");
      }
      if (this.address_line_2State == false) {
        return this.$root.makeToast("danger", "Kiểm tra lại Địa chỉ chi tiết!");
      }

      if (this.zipcodeState == false) {
        return this.$root.makeToast("danger", "Kiểm tra lại Mã Số Bưu Chính!");
      }
      if (this.status == "not_accepted") {
        return this.$root.makeToast(
          "danger",
          "Bạn chưa chấp nhận các điều khoản khi đặt mua sản phẩm tại cửa hàng chúng tôi!"
        );
      }
      if (this.phone == null) {
        return this.$root.makeToast(
          "danger",
          "Địa chỉ này vẫn chưa có sđt mặc định, vui lòng cập nhật số điện thoại của bạn trước khi đặt hàng!"
        );
      }
      if (this.createAccount == "true") {
        axios
          .post("./api/order_create_account", {
            email: this.email,
            fullname: this.fullname,
            phone: this.phone,
            address_line_1: this.address_line_1,
            address_line_2: this.address_line_2,
            wards: this.wards,
            district: this.district,
            city: this.city,
            zipcode: this.zipcode,
          })
          .then((response) => {
            this.$root.makeToast(response.data.status, response.data.mess);
            if (response.data.status == "danger") {
              return false;
            }
          });
      }
      if (this.$store.state.cart.length == 0) {
        return this.$root.makeToast("danger", "Giỏ hàng trống");
      }
      axios
        .post("./order", {
          fullname: this.fullname,
          email: this.email,
          phone: this.phone,
          address_line_1: this.address_line_1,
          address_line_2: this.address_line_2,
          wards: this.wards,
          district: this.district,
          city: this.city,
          country: "VN",
          zipcode: this.zipcode,
          note: this.note,
          voucher: this.$parent.$parent.voucher,
          shipping: this.$parent.$parent.selected,
          cart: this.$parent.$parent.cart,
          final_price: this.$parent.$parent.grandtotal,
          note: this.note,
        })
        .then((response) => {
          if (response.data.status == "success") {
            this.$root.makeToast(response.data.status, response.data.mess);
            this.$store.dispatch("clearCart");
            setTimeout(() => {
              return (window.location.href =
                "/order-summary/order=" + response.data.order);
            }, 1000);
          } else {
            this.$root.makeToast(response.data.status, response.data.mess);
          }
        });
    },
    get_my_address() {
      axios
        .get("./api/address/user/" + this.user_address.refresh_token)
        .then((response) => {
          if (response.data.status == "success") {
            this.addressList = response.data.address;
          }
          return this.$root.makeToast(response.data.status, response.data.mess);
        });
    },
    apply_address(selected) {
      if (selected == false) {
        this.address_line_1 = "";
        this.address_line_2 = "";
        this.wards = "";
        this.district = "";
        this.city = "";
        this.country = "";
        this.zipcode = "";
        this.show = "";
      } else {
        let address = this.addressList.find((data) => data.id == selected);
        if (address.country == "VN" || address.country == null) {
          Vue.nextTick(() => {
            axios
              .get(
                "/api/show_my_address/" +
                  address.wards +
                  "-" +
                  address.district +
                  "-" +
                  address.city
              )
              .then((data) => {
                this.address_line_1 =
                  address.address_line_1 != null ? address.address_line_1 : "";
                this.address_line_2 =
                  address.address_line_2 != null ? address.address_line_2 : "";
                this.wards = address.wards;
                this.district = address.district;
                this.city = address.city;
                this.country = address.country;
                this.zipcode = address.zip_code;
                this.show =
                  this.address_line_1 +
                  " " +
                  this.address_line_2 +
                  " " +
                  data.data +
                  " ";
                this.country + " ";
                this.zipcode;
              });
          });
        } else {
          this.$root.makeToast(
            "danger",
            "Hiện tại hệ thống không hỗ trợ ship ra nước ngoài ! Vui lòng chọn địa chỉ khác"
          );
        }
      }
    },
  },
  computed: {
    //Validate
    nameState() {
      return this.fullname.length > 0 ? true : false;
    },
    emailState() {
      if (this.user_address != null) {
        return true;
      }
      return this.email.length > 0 ? true : false;
    },
    phoneState() {
      if (this.user_address != null) {
        return true;
      }
      return this.phone.length > 0 ? true : false;
    },
    address_line_1State() {},
    address_line_2State() {},
    wardsState() {
      return this.wards.length > 0 ? true : false;
    },
    districtState() {
      return this.district.length > 0 ? true : false;
    },
    cityState() {
      return this.city.length > 0 ? true : false;
    },
    zipcodeState() {
      return this.zipcode.length > 0 ? true : false;
    },
  },
  created() {
    this.get_cities();
    if (this.user_address) {
      this.fullname = this.user_address.user_name;
      this.email = this.user_address.email;
      this.phone =
        this.user_address.phone.length > 0
          ? this.user_address.phone[0].number
          : null;
      this.get_my_address();
    }
  },
};
</script>

<style>
</style>