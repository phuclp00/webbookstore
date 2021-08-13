<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12"></div>
    </div>
    <div class="row mt--60">
      <div class="col-lg-5 col-md-5 col-12">
        <div class="contact_adress">
          <div class="ct_address">
            <h3 class="ct_title">Địa Chỉ & Thông Tin Chi Tiết</h3>
            <p>
              Trường Đại Học Công Nghệ Sài Gòn (STU) đào tạo đa ngành, đa lĩnh
              vực với các trình độ: Cao đẳng, Đại học, Thạc sĩ và Tiến sĩ; Cung
              cấp nguồn nhân lực chất lượng cao theo hướng công nghệ, có phẩm
              chất đạo đức tốt, có văn hóa, ngoại ngữ và chuyên môn nghiệp vụ
              giỏi phù hợp ngày càng cao nhu cầu của sự phát triển kinh tế xã
              hội, của đất nước, của cộng đồng và nhu cầu học tập của nhân dân.
            </p>
          </div>
          <div class="address_wrapper">
            <div class="address">
              <div class="icon">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div class="contact-info-text">
                <p>
                  <span>Address:</span> 180 Cao Lỗ - phường 4 - quận 8 <br />
                  Thành phố Hồ Chí Minh
                </p>
              </div>
            </div>
            <div class="address">
              <div class="icon">
                <i class="far fa-envelope"></i>
              </div>
              <div class="contact-info-text">
                <p><span>Email: </span> locdo255@gmail.com</p>
              </div>
            </div>
            <div class="address">
              <div class="icon">
                <i class="fas fa-mobile-alt"></i>
              </div>
              <div class="contact-info-text">
                <p><span>Điện Thoại:</span> (+84) 0374407507</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-md-7 col-12 mt--30 mt-md--0">
        <div class="contact_form">
          <h3 class="ct_title">Gửi Phản Hồi Cho Chúng Tôi</h3>

          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Họ & Tên <span class="required">*</span></label>
                <input
                  type="text"
                  id="con_name"
                  v-model="name"
                  name="con_name"
                  class="form-control"
                  required
                />
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <input
                  type="email"
                  id="con_email"
                  name="con_email"
                  v-model="email"
                  class="form-control"
                  required
                />
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Số Điện Thoại*</label>
                <input
                  type="text"
                  v-model="phone"
                  id="con_phone"
                  name="con_phone"
                  class="form-control"
                />
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Nội Dung Thư: </label>
                <textarea
                  id="con_message"
                  v-model="mess"
                  name="con_message"
                  class="form-control"
                ></textarea>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-btn">
                <button
                  id="submit"
                  class="btn btn-black"
                  name="submit"
                  @click="send()"
                >
                  Xác Nhận
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      mess: "",
    };
  },
  methods: {
    send() {
      if (
        this.name != "" &&
        this.email != "" &&
        this.phone != "" &&
        this.mess != ""
      ) {
        axios
          .post("/contact/email", {
            name: this.name,
            email: this.email,
            phone: this.phone,
            mess: this.mess,
          })
          .then((response) => {
            this.$root.makeToast(response.data.status, response.data.mess);
            if (response.data.status == "success") {
              this.name = "";
              this.email = "";
              this.phone = "";
              this.mess = "";
            }
          });
      } else {
        this.$root.makeToast(
          "danger",
          "Các thông tin để gửi email không được để trống !"
        );
      }
    },
  },
};
</script>

<style>
</style>