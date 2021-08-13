<template>
  <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb--30 mb-lg--0">
    <!-- Login Form s-->
    <div class="login-form">
      <form>
        <h4 class="login-title">Đăng Ký Tài Khoản</h4>
        <p><span class="font-weight-bold">Khách Hàng Mới</span></p>
        <div class="row">
          <div class="col-md-12 col-12 mb--15">
            <label for="email">Họ và Tên</label>
            <b-form-input
              class="mb-0 form-control"
              type="text"
              v-model="usernameRegister"
              placeholder="Họ và Tên"
              trim
              autocomplete="true"
            ></b-form-input>
            <div class="mb-0 text-danger" v-show="usernameState">
              Họ và Tên không được để trống
            </div>
          </div>
          <div class="col-12 mb--20">
            <label for="email">Email</label>
            <b-form-input
              class="mb-0 form-control"
              type="email"
              v-model="emailRegister"
              placeholder="Enter Your Email Address Here.."
              trim
            ></b-form-input>
            <div class="mb-0 text-danger" v-show="emailState">
              Email không được để trống
            </div>
          </div>
          <div class="col-lg-6 mb--20">
            <label for="password">Mật Khẩu</label>
            <b-form-input
              class="mb-0 form-control"
              type="password"
              name="current-password"
              id="current-password"
              v-model="passwordRegister"
              placeholder="Nhập vào mật khẩu của bạn"
              autocomplete="true"
            ></b-form-input>
            <div class="mb-0 text-danger" v-show="passwordState">
              Mật khẩu không được để trống
            </div>
          </div>
          <div class="col-lg-6 mb--20">
            <label for="password">Nhập Lại Mật Khẩu</label>
            <b-form-input
              class="mb-0 form-control"
              type="password"
              name="repeat-password"
              v-model="repasswordRegister"
              placeholder="Nhâọ lại mật khẩu"
              autocomplete="true"
            ></b-form-input>
            <div class="mb-0 text-danger" v-show="check_repasswordState">
              Nhập lại mật khẩu không đúng với ban đầu
            </div>
          </div>
          <div class="col-md-12">
            <b-overlay
              :show="busy"
              rounded
              opacity="0.6"
              spinner-small
              spinner-variant="primary"
              class="d-inline-block"
              @hidden="onHidden"
            >
              <a
                type="submit"
                ref="button"
                href="javascript:void(0)"
                @click="register()"
                class="btn btn-outlined"
                >Đăng Ký Tài Khoản</a
              >
            </b-overlay>
          </div>
        </div>
      </form>
    </div>
    <b-overlay :show="show" no-wrap> ></b-overlay>
  </div>
</template>
<script>
Vue.component("ring-loader", require("vue-spinner/src/RingLoader.vue").default);

export default {
  data() {
    return {
      usernameRegister: "",
      emailRegister: "",
      passwordRegister: "",
      repasswordRegister: "",
      usernameState: false,
      emailState: false,
      passwordState: false,
      repasswordState: false,
      busy: false,
      show: false,
    };
  },
  computed: {
    check_repasswordState() {
      if (this.passwordRegister != this.repasswordRegister) {
        return (this.repasswordState = true);
      }
      return (this.repasswordState = false);
    },
  },
  methods: {
    onHidden() {
      // Return focus to the button once hidden
      this.$refs.button.focus();
    },
    check() {
      this.emailState = this.emailRegister == "";
      this.usernameState = this.usernameRegister == "";
      this.passwordState = this.passwordRegister == "";
      this.repasswordState = this.repasswordRegister != this.passwordRegister;
      if (
        this.emailState ||
        this.usernameState ||
        this.passwordState ||
        this.repasswordState
      ) {
        return false;
      }
      return true;
    },
    register() {
      this.busy = true;
      if (this.check() == false) {
        this.busy = false;
        return this.$root.makeToast("danger", "Kiểm tra lại thông tin đăng ký");
      } else {
        axios
          .post("./register", {
            username: this.usernameRegister,
            password: this.passwordRegister,
            email: this.emailRegister,
          })
          .then((response) => {
            Vue.nextTick(() => {
              this.busy = false;
            }, 2000);
            this.$root.makeToast(response.data.status, response.data.mess);
            if (response.data.status == "success") {
              this.show = true;
              axios
                .post("./login", {
                  email: this.emailRegister,
                  password: this.passwordRegister,
                })
                .then((login) => {
                  this.show = false;
                  this.$root.makeToast(
                    response.data.status,
                    response.data.mess
                  );
                  if (response.data.status == "success") {
                    Vue.nextTick((e) => {
                      window.location.href = "./";
                    });
                  }
                });
            }
          });
      }
    },
  },
};
</script>

<style>
</style>