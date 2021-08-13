<template>
  <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
    <div class="login-form">
      <h4 class="login-title">Tôi Đã Có Tài Khoản</h4>
      <p><span class="font-weight-bold">Đăng Nhập</span></p>
      <form>
        <div class="row">
          <div class="col-md-12 col-12 mb--15">
            <label for="email">Nhập emai của bạn tại đây...</label>
            <b-form-input
              v-model="email"
              class="mb-0 form-control"
              id="login-email"
              name="login-email"
              type="email"
              placeholder="Nhập emai của bạn tại đây..."
              trim
              autocomplete="true"
            ></b-form-input>
          </div>
          <div class="col-12 mb--20">
            <label for="password">Mật Khẩu</label>
            <b-form-input
              v-model="password"
              class="mb-0 form-control"
              type="password"
              id="login-password"
              name="login-password"
              placeholder="Nhập mật khẩu của bạn tại đây...."
              autocomplete="true"
            ></b-form-input>
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
                @click="login()"
                class="btn btn-outlined"
              >
                Đăng Nhập
              </a>
            </b-overlay>
          </div>
          <div class="col-md-6">
            <div style="margin-top: 20px">
              <a href="/auth/google">
                <img src="/images/icons/google.png" alt="Login with Google" />
              </a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      password: "",
      email: "",
      busy: false,
    };
  },
  mounted() {},
  methods: {
    onHidden() {
      // Return focus to the button once hidden
      this.$refs.button.focus();
    },
    login() {
      this.busy = true;
      if (this.password == "" || this.email == "") {
        this.busy = false;
        return this.$root.makeToast(
          "danger",
          "Email và Mật khẩu không được để trống !"
        );
      } else {
        axios
          .post("./login", { email: this.email, password: this.password })
          .then((response) => {
            this.busy = false;
            this.$root.makeToast(response.data.status, response.data.mess);
            if (response.data.status == "success") {
              Vue.nextTick((e) => {
                window.location.href = "./";
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