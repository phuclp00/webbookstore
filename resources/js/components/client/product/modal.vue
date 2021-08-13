<template>
  <div
    class="modal fade modal-quick-view"
    id="quickModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="quickModal"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button
          type="button"
          class="close modal-close-btn ml-auto"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="product-details-modal">
          <div class="row">
            <div class="col-lg-5">
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
                v-if="book.thumb != null"
              >
                <div
                  class="single-slide"
                  v-for="image in book.thumb"
                  :key="image.book_id"
                >
                  <img :src="'/' + image.image" :alt="book.book_name" />
                </div>
              </div>
              <!-- Product Details Slider Nav -->
              <div
                class="mt--30 product-slider-nav sb-slick-slider arrow-type-two"
                data-slick-setting='{
            "infinite":true,
              "autoplay": true,
              "autoplaySpeed": 8000,
              "slidesToShow": 4,
              "arrows": true,
              "prevArrow":{"buttonClass": "slick-prev","iconClass":"fa fa-chevron-left"},
              "nextArrow":{"buttonClass": "slick-next","iconClass":"fa fa-chevron-right"},
              "asNavFor": ".product-details-slider",
              "focusOnSelect": true
              }'
                v-if="book.thumb != null"
              >
                <div
                  class="single-slide"
                  v-for="image in book.thumb"
                  :key="image.book_id"
                >
                  <img :src="'/' + image.image" :alt="book.book_name" />
                </div>
              </div>
            </div>
            <div class="col-lg-7 mt--30 mt-lg--30">
              <div class="product-details-info pl-lg--30">
                <p class="tag-block">
                  Tags:
                  <a class="text-primary" v-for="tag in book.tags" :key="tag.id"
                    >#{{ tag.name }} &nbsp;</a
                  >
                </p>
                <h3 class="product-title">{{ book.book_name }}</h3>
                <ul class="list-unstyled">
                  <li>
                    Tác giả:
                    <a
                      class="list-value font-weight-bold"
                      v-for="author in book.author"
                      :key="author.id"
                    >
                      {{ author.name }} &nbsp;&nbsp;</a
                    >
                  </li>
                  <li>
                    BarCode:
                    <span class="list-value"> {{ book.serialNumber }}</span>
                  </li>
                  <li>
                    Tình Trạng:
                    <span class="list-value" v-if="book.total > 0">
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
                <div class="price-block" v-if="book.promotion">
                  <span class="price">{{
                    (book.price - (book.price * book.promotion.percent) / 100)
                      | currency("đ", 0, {
                        symbolOnLeft: false,
                        spaceBetweenAmountAndSymbol: true,
                      })
                  }}</span>
                  <del class="price-old">{{
                    book.price
                      | currency("đ", 0, {
                        symbolOnLeft: false,
                        spaceBetweenAmountAndSymbol: true,
                      })
                  }}</del>
                  <span class="price-discount"
                    >{{ book.promotion.percent }}%</span
                  >
                </div>
                <div class="price-block" v-else>
                  <span class="price">{{
                    book.price
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
                        index > book.rating
                          ? 'fas fa-star'
                          : 'fas fa-star star_on',
                      ]"
                    ></span>
                  </div>
                  <div class="review-widget">
                    <a href="">({{ book.rating.length }} Đánh Giá)</a>
                    <span>|</span>
                    <a href="">Write a review</a>
                  </div>
                </div>
                <article class="product-details-article">
                  <h4 class="sr-only">Sơ Lược Nội Dung</h4>
                  <p v-html="truncate(book.description, 350, '.....')"></p>
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
                    <cartMulti :product="book" :quantity="quantity"></cartMulti>
                  </div>
                </div>
                <div class="compare-wishlist-row">
                  <a
                    href="javascript:void(0)"
                    class="add-link"
                    @click="addFavorite(book)"
                    ><i class="fas fa-heart"></i>
                    Thêm vào danh sách yêu thích
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="widget-social-share">
            <span class="widget-label">Share:</span>
            <div class="modal-social-share">
              <a href="#" class="single-icon"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a href="#" class="single-icon"><i class="fab fa-twitter"></i></a>
              <a href="#" class="single-icon"><i class="fab fa-youtube"></i></a>
              <a href="#" class="single-icon"
                ><i class="fab fa-google-plus-g"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import algoliasearch from "algoliasearch/lite";
import cartMulti from "../vendor/add-cart-button-multi.vue";
export default {
  components: { cartMulti },

  props: ["book"],
  data() {
    return {
      searchClient: algoliasearch(
        "K177MITG7W",
        "7ffdbc248bd1211b1bd1696f1d89cfa6"
      ),
      insightsClient: window.aa,
      quantity: 0,
    };
  },
  computed: {
    url() {
      return window.location.pathname;
    },
  },
  methods: {
    check_quantity() {
      if (this.quantity < 1) {
        this.quantity = 1;
        return this.$root.makeToast("danger", "Số lượng không được nhỏ hơn 1");
      }
      return true;
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
    truncate: function (text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
    },
  },
};
</script>

<style>
</style>