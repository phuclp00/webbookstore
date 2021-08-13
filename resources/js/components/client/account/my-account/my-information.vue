<template>
  <div class="myaccount-content">
    <h3>Thông Tin Tài Khoản</h3>
    <div class="account-details-form">
      <form action="#">
        <div class="row">
          <!-- Name -->
          <b-form-group
            id="field-name"
            description="Nhập Họ và Tên của bạn....."
            class="col-12 mb--30"
            label="Họ và Tên :"
            label-for="input-name"
          >
            <b-form-input
              id="input-name"
              v-model="name"
              @change="nameState"
              :placeholder="information.user_name"
              trim
            ></b-form-input>
            <div class="mb-0 text-danger" v-show="nameState">
              Họ và Tên không hợp lệ
            </div>
          </b-form-group>
          <!-- Email -->
          <b-form-group
            id="fieldset-email"
            description="Nếu bạn thay đổi email, bạn cần phải đăng nhập lại theo email mới."
            class="col-12 mb--30"
            label="Email hiện tại của bạn"
          >
            <b-form-input
              id="input-email"
              v-model="email"
              :placeholder="information.email"
              @change="emailState"
              trim
            ></b-form-input>
          </b-form-group>
          <!-- Số điện thoại -->
          <b-form-group
            id="fieldset-phone"
            class="col-12 mb--30"
            label="Danh sách số điện thoại của bạn: "
          >
            <ul>
              <li v-for="(index, key) in phonelist" :key="key">
                <b style="margin-right: 10px">{{ key + 1 + " - (+84)" }}</b
                ><span
                  >{{ index.text }} <b v-if="key == 0"> (Mặc định)</b></span
                >
                <b-link class="bold text-red" @click="phone_edit(index)"
                  >Chỉnh sửa
                </b-link>
                <span> &nbsp;</span>
                <b-link
                  v-if="key > 0"
                  class="text-red"
                  @click="phone_default(index.text)"
                  >Đặt làm số điện thoại mặc định</b-link
                >
              </li>
            </ul>
            <!-- Thay đổi số -->
            <b-form-group>
              <b-form-input
                v-show="current_phone != ''"
                v-model="current_phone"
                type="number"
                @change="phoneState"
                trim
              ></b-form-input>
              <div class="mb-0 text-danger" v-show="phoneState">
                Số điện thoại không hợp lệ : Số điện thoại phải ít nhất 9 chữ số
              </div>
            </b-form-group>
          </b-form-group>
          <!-- Thêm số -->
          <b-form-group
            id="fieldset-new-phone"
            class="col-12 mb--30"
            label="Thêm số mới"
          >
            <b-form-input
              id="input-new-phone"
              v-model="new_phone"
              @change="new_phoneState"
              trim
            ></b-form-input>
            <div class="mb-0 text-danger" v-show="new_phoneState">
              Số điện thoại không hợp lệ : Số điện thoại phải ít nhất 9 chữ số
            </div>
          </b-form-group>
          <!-- Submit -->
          <div class="col-12">
            <b-button
              id="information-update"
              name="information-update"
              class="btn btn--primary"
              @click="apply()"
              >Xác Nhận</b-button
            >
          </div>
          <div class="col-12 mb--30">
            <h4 style="margin-top: 20px">Thay đổi mật khẩu</h4>
          </div>
          <div class="col-12 mb--30">
            <input
              id="current-pwd"
              v-model="password"
              placeholder="Mật khẩU hiện tại"
              type="password"
              trim
            />
          </div>
          <div class="col-lg-6 col-12 mb--30">
            <input
              id="new-pwd"
              v-model="newpassword"
              placeholder="Mật khẩu mới"
              type="password"
              trim
            />
          </div>
          <div class="col-lg-6 col-12 mb--30">
            <b-form-input
              id="confirm-pwd"
              v-model="confimpassword"
              @change="repeatpass"
              placeholder="Nhập lại mật khẩu"
              type="password"
              trim
            ></b-form-input>
            <div class="mb-0 text-danger" v-show="repeatpass">
              Mật khẩu nhập lại không giống với mật khẩu mới
            </div>
          </div>
          <div class="col-12">
            <b-form-input
              id="password-confim"
              name="password-confim"
              class="btn btn-primary"
              @click="changepassword()"
              value="Thay đổi mật khẩu"
            ></b-form-input>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      new_phone: "",
      phonelist: [],
      current_phone: "",
      information: [],
      password: "",
      confimpassword: "",
      newpassword: "",
    };
  },
  computed: {
    nameState() {
      if (this.name == "") {
        return false;
      }
    },
    repeatpass() {
      return this.newpassword == this.confimpassword ? false : true;
    },
    emailState() {
      if (this.email == "") {
        return false;
      }
      return false;
    },
    phoneState() {
      if (this.current_phone == "") {
        return false;
      }
      if (this.current_phone.length > 0) {
        return this.current_phone.length > 9 ? false : true;
      }
      return false;
    },
    new_phoneState() {
      if (this.new_phone == "") {
        return false;
      }
      if (this.new_phone.length > 0) {
        return this.new_phone.length >= 9 ? false : true;
      }
      return false;
    },
  },
  methods: {
    get_phone_list() {
      axios
        .get("/api/phone/user/" + this.user.refresh_token)
        .then((response) => {
          response.data.data.forEach((phone) => {
            return this.phonelist.push({
              value: phone.id,
              text: phone.number,
            });
          });
        });
    },
    phone_edit(phone) {
      return [(this.current_phone = phone.text), (this.phone = phone.text)];
    },
    phone_default(number) {
      axios
        .post("/my-account/phone-set-default", { number: number })
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          if (response.data.status == "success") {
            this.phonelist = [];
            this.get_phone_list();
          }
        });
    },
    apply() {
      axios
        .post("/my-account/account-update", {
          token: this.user.refresh_token,
          name: this.name,
          email: this.email,
          new_phone: this.new_phone,
          phone: this.phone,
          current_phone: this.current_phone,
        })
        .then((response) => {
          this.$root.makeToast(response.data.status, response.data.mess);
          if (response.data.status == "success") {
            Vue.nextTick(() => {
              window.location.reload();
            });
          }
        });
    },
    changepassword() {
      if (this.repeatpass == false) {
        axios
          .post("/my-account/password/update", {
            token: this.user.refresh_token,
            password: this.password,
            new_password: this.newpassword,
          })
          .then((response) => {
            this.$root.makeToast(response.data.status, response.data.mess);
            if (response.data.status == "success") {
              return window.location.reload();
            }
          });
      }
    },
  },
  created() {
    this.get_phone_list();
    this.information = this.user;
  },
};
</script>

<style>
</style>