<template>
  <main class="inner-page-sec-padding-bottom">
    <div class="container">
      <div class="row mb--60">
        <div class="col-lg-5 mb--30">
          <div class="row no-gutters">
            <div class="col-sm-9 mb--15 mb-sm--0 order-sm-2">
              <!-- Product Details Slider Big Image-->
              <div
                class="product-details-slider sb-slick-slider arrow-type-two"
                data-slick-setting='{
                        "slidesToShow": 1,
                        "arrows": false,
                        "fade": true,
                        "draggable": false,
                        "swipe": false,
                        "asNavFor": ".product-slider-nav"
                        }'
              >
                <div class="single-slide">
                  <img
                    :src="'/' + product.img"
                    :alt="'Images Thumbnai' + product.book_name"
                  />
                </div>
                <div
                  class="single-slide"
                  v-for="thumb in product.thumb"
                  :key="thumb.id"
                >
                  <img
                    :src="'/' + thumb.image"
                    :alt="'Images Thumbnai' + thumb.id"
                  />
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <!-- Product Details Slider Nav -->
              <div
                class="
                  mr-sm--15
                  product-slider-nav
                  sb-slick-slider
                  arrow-type-two
                  vertical-slider
                "
                data-slick-setting='{
                                "infinite":true,
                                  "autoplay": true,
                                  "autoplaySpeed": 8000,
                                  "slidesToShow": 3,
                                  "arrows": true,
                                  "prevArrow":{"buttonClass": "slick-prev","iconClass":"fa fa-chevron-left"},
                                  "nextArrow":{"buttonClass": "slick-next","iconClass":"fa fa-chevron-right"},
                                  "asNavFor": ".product-details-slider",
                                  "focusOnSelect": true,
                                  "vertical":true
                                  }'
                data-slick-responsive='[
                                {"breakpoint":991, "settings": {"slidesToShow": 3} },
                                {"breakpoint":768, "settings": {"slidesToShow": 3} },
                                {"breakpoint":575, "settings": 
                                {"slidesToShow": 3,
    
                                  "vertical":false
                                } 
                              }
                            ]'
              >
                <div class="single-slide">
                  <img
                    :src="'/' + product.img"
                    :alt="'Images Thumbnai' + product.book_name"
                  />
                </div>
                <div
                  class="single-slide"
                  v-for="thumb in product.thumb"
                  :key="thumb.id"
                >
                  <img
                    :src="'/' + thumb.image"
                    :alt="'Images Thumbnai' + thumb.id"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="product-details-info pl-lg--30">
            <p>
              <i class="fas fa-eye"></i> {{ view }} Người đã xem sản phẩm này
            </p>
            <p class="tag-block">
              Tags:
              <a class="text-primary" v-for="tag in product.tags" :key="tag.id"
                >#{{ tag.name }} &nbsp;</a
              >
            </p>
            <h3 class="product-title">{{ product.book_name }}</h3>
            <ul class="list-unstyled">
              <li>
                Tác giả:
                <a
                  class="list-value font-weight-bold"
                  v-for="author in product.author"
                  :key="author.id"
                >
                  {{ author.name }} &nbsp;&nbsp;</a
                >
              </li>
              <li>
                BarCode:
                <span class="list-value"> {{ product.serialNumber }}</span>
              </li>
              <li>
                Tình Trạng:
                <span class="list-value" v-if="product.total > 0">
                  Còn hàng
                </span>
                <span class="list-value text-danger" v-else>Hết hàng</span>
              </li>
              <li>
                <div
                  class="fb-like"
                  :data-href="url"
                  data-width=""
                  data-layout="standard"
                  data-action="like"
                  data-size="small"
                  data-share="true"
                ></div>
              </li>
            </ul>
            <div class="price-block" v-if="product.promotion">
              <span class="price">{{
                (product.price -
                  (product.price * product.promotion.percent) / 100)
                  | currency("đ", 0, {
                    symbolOnLeft: false,
                    spaceBetweenAmountAndSymbol: true,
                  })
              }}</span>
              <del class="price-old">{{
                product.price
                  | currency("đ", 0, {
                    symbolOnLeft: false,
                    spaceBetweenAmountAndSymbol: true,
                  })
              }}</del>
              <span class="price-discount"
                >{{ product.promotion.percent }}%</span
              >
            </div>
            <div class="price-block" v-else>
              <span class="price">{{
                product.price
                  | currency("đ", 0, {
                    symbolOnLeft: false,
                    spaceBetweenAmountAndSymbol: true,
                  })
              }}</span>
            </div>
            <div class="rating-widget">
              <div class="rating-block">
                <span
                  v-for="index in 5"
                  :key="index"
                  :class="[
                    index > product.rating
                      ? 'fas fa-star'
                      : 'fas fa-star star_on',
                  ]"
                ></span>
              </div>
              <div class="review-widget">
                <a href="">({{ product.rating.length }} Đánh Giá)</a>
                <span>|</span>
                <a href="">Write a review</a>
              </div>
            </div>
            <article class="product-details-article">
              <h4 class="sr-only">Sơ Lược Nội Dung</h4>
              <p v-html="truncate(product.description, 350, '.....')"></p>
            </article>
            <div class="add-to-cart-row">
              <div class="count-input-block">
                <span class="widget-label">Số Lượng</span>
                <input
                  type="number"
                  v-model="quantity"
                  @change="check_quantity()"
                  class="form-control text-center"
                />
              </div>
              <div class="add-cart-btn">
                <cartMulti :product="product" :quantity="quantity"></cartMulti>
              </div>
            </div>
            <div class="compare-wishlist-row">
              <a
                href="javascript:void(0)"
                class="add-link"
                @click="addFavorite(product)"
                ><i class="fas fa-heart"></i>Thêm vào danh sách yêu thích</a
              >
              <a href="#" class="add-link"
                ><i class="fas fa-random"></i>Add to Compare</a
              >
            </div>
          </div>
        </div>
      </div>
      <div class="sb-custom-tab review-tab section-padding">
        <ul class="nav nav-tabs nav-style-2" id="myTab2" role="tablist">
          <li class="nav-product">
            <a
              class="nav-link active"
              id="tab1"
              data-toggle="tab"
              href="#tab-1"
              role="tab"
              aria-controls="tab-1"
              aria-selected="true"
            >
              MÔ TẢ SÁCH
            </a>
          </li>
          <li class="nav-product">
            <a
              class="nav-link"
              id="tab2"
              data-toggle="tab"
              href="#tab-2"
              role="tab"
              aria-controls="tab-2"
              aria-selected="true"
            >
              LƯỢT ĐÁNH GIÁ ({{ product.rating.length }})
            </a>
          </li>
        </ul>
        <div class="tab-content space-db--20" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="tab-1"
            role="tabpanel"
            aria-labelledby="tab1"
          >
            <article class="review-article">
              <h1 class="sr-only">MÔ TẢ SÁCH</h1>
              <div v-html="product.description"></div>
            </article>
          </div>
          <div
            class="tab-pane fade"
            id="tab-2"
            role="tabpanel"
            aria-labelledby="tab2"
          >
            <div class="review-wrapper">
              <h2 class="title-lg mb--20 text-uppercase">
                {{ product.rating.length }} LƯỢT ĐÁNH GIÁ CHO SẢN PHẨM:
                {{ product.book_name }}
              </h2>
              <div
                class="review-comment mb--20"
                v-for="(rating, key) in product.rating"
                :key="key"
              >
                <div class="avatar">
                  <img
                    :src="
                      rating.image != null
                        ? rating.image
                        : '/images/users/user_default.svg'
                    "
                    :alt="rating.user_name"
                  />
                </div>
                <div class="text">
                  <div class="row">
                    <div class="col rating-block mb--15">
                      <span
                        v-for="index in 5"
                        :key="index"
                        :class="
                          index > rating.pivot.rating
                            ? 'ion-android-star-outline'
                            : ' ion-android-star-outline star_on'
                        "
                      ></span>
                    </div>
                    <div class="col">
                      <a
                        href="javascript:void(0)"
                        @click="deleted_rating(rating.pivot.id)"
                        class="float-right text-danger"
                        >X</a
                      >
                    </div>
                  </div>
                  <h5 class="author">
                    {{ rating.email }} –
                    <span class="font-weight-400">{{
                      $root.datetime(rating.pivot.created_at)
                    }}</span>
                  </h5>
                  <h6 class="font-weight-bold">{{ rating.pivot.title }}</h6>
                  <p>
                    {{ rating.pivot.comment }}
                  </p>
                </div>
              </div>
              <div v-if="isBuying">
                <div v-if="isRating">
                  <h2 class="title-lg mb--20 pt--15">
                    VIẾT BÌNH CHỌN CHO SẢN PHẨM NÀY
                  </h2>
                  <div class="rating-row pt-2">
                    <label for="rating-sm">Mức độ yêu thích</label>
                    <b-form-rating
                      id="rating-sm"
                      variant="warning"
                      class="col-md-3 mb-2"
                      v-model="rating"
                    ></b-form-rating>
                    <div class="mt--15 site-form">
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="name">Tiêu đề: *</label>
                            <input
                              type="text"
                              id="name"
                              v-model="title"
                              class="form-control"
                            />
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                            <label for="message">Bình Luận</label>
                            <textarea
                              name="message"
                              v-model="mess"
                              id="message"
                              cols="30"
                              rows="10"
                              class="form-control"
                            ></textarea>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="submit-btn">
                            <button class="btn btn-black" @click="send()">
                              Xác Nhận
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div v-else>
                  <small>Bạn đã bình chọn sản phẩm này rồi</small>
                </div>
              </div>
              <div v-else class="rating-row pt-2">
                <small
                  >"Bạn không thể đánh giá vì không có sản phẩm này trong đơn
                  hàng của bạn !"</small
                >
              </div>
            </div>
          </div>
          <div class="mb-4">
            <div
              class="fb-comments"
              :x-id="product.book_id"
              data-width="100%"
              data-numposts="5"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import algoliasearch from "algoliasearch/lite";
import "instantsearch.css/themes/satellite-min.css";
import cartMulti from "../vendor/add-cart-button-multi.vue";
import related from "../product/product_relation.vue";
export default {
  components: { cartMulti, related },
  props: ["product_detail", "view"],
  data() {
    return {
      quantity: 1,
      isBuying: false,
      rating: null,
      isRating: false,
      title: "",
      mess: "",
      product: [],
      hits: {
        objectID: this.product_detail.book_id,
        name: this.product_detail.book_name,
        brand: this.product_detail.category.name,
        author: this.product_detail.author.name,
      },
      searchClient: algoliasearch(
        "K177MITG7W",
        "7ffdbc248bd1211b1bd1696f1d89cfa6"
      ),
      matchingPatterns: {
        series: { score: 1 },
        brand: { score: 2 },
        author: { score: 4 },
      },
      addFavorite(item) {
        axios.post("/my-account/favorite", { item: item }).then((response) => {
          this.items.push(item.book_id);
          //Send event
          aa("clickedObjectIDs", {
            index: "book",
            eventName: "Favorite Clicked",
            objectIDs: this.items,
            clickAnalytics: true,
          });
          return this.$root.makeToast(response.data.status, response.data.mess);
        });
      },
    };
  },
  computed: {
    url() {
      return window.location.pathname;
    },
  },
  methods: {
    deleted_rating(id) {
      axios.delete("/shop/product/rating" + id).then((response) => {
        this.$root.makeToast(response.data.status, response.data.mess);

        if (response.data.status == "success") {
          window.location.reload();
        }
      });
    },
    check_quantity() {
      if (this.quantity < 1) {
        this.quantity = 1;
        return this.$root.makeToast("danger", "Số lượng không được nhỏ hơn 1");
      }
      return true;
    },
    truncate: function (text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
    },
    shareFB() {
      FB.ui(
        {
          display: "popup",
          method: "share",
          href: "http://www.booksto.tk",
        },
        function (response) {}
      );
    },
    check_role_review() {
      axios
        .post("/shop/product/check-role-review", { id: this.product.book_id })
        .then((response) => {
          if (response.data.status == "success") {
            return (this.isBuying = true);
          }
          return false;
        });
    },
    check_rating() {
      axios
        .post("/shop/product/check-rating-review", { id: this.product.book_id })
        .then((response) => {
          if (response.data.status == "success") {
            return (this.isRating = true);
          }
          return false;
        });
    },
    send() {
      if (this.title.length > 50) {
        return this.$root.makeToast(
          "danger",
          "Tiêu đề không được quá 50 kí tự !"
        );
      }
      if (this.mess.length > 255) {
        return this.$root.makeToast(
          "danger",
          "Bình luận không được quá 255 kí tự !"
        );
      }
      if (this.title == "" || this.mess == "" || this.rating == null) {
        return this.$root.makeToast(
          "danger",
          " các mục liên quan đến phần bình chọn không được để trống !"
        );
      } else {
        axios
          .post("/shop/product/rating", {
            rating: this.rating,
            title: this.title,
            mess: this.mess,
            id: this.product.book_id,
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
    this.product = this.product_detail;
    this.check_role_review();
    this.check_rating();
  },
};
</script>

<style>
</style>