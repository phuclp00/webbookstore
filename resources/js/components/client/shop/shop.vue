<template>
  <ais-instant-search
    index-name="book"
    :search-client="searchClient"
    :stalled-search-delay="1000"
    :insights-client="insightsClient"
  >
    <ais-configure clickAnalytics="true" :analytics="true" />
    <div class="inner-page-sidebar">
      <!-- Clear Filter -->
      <div class="singgle-block">
        <ais-clear-refinements />
      </div>
      <div class="single-block">
        <h3 class="sidebar-title">Tìm kiếm</h3>
        <ais-search-box />
      </div>
      <!-- Danh mục -->
      <div class="single-block">
        <h3 class="sidebar-title">Danh Mục</h3>
        <ais-hierarchical-menu
          style="max-width: 250px"
          :class-names="{
            'ais-HierarchicalMenu-list': 'sidebar-menu--shop',
          }"
          :attributes="[
            'categories.level10',
            'categories.level11',
            'categories.level12',
            'categories.level13',
            'categories.level14',
          ]"
          show-more
        >
        </ais-hierarchical-menu>
      </div>
      <!-- Giá cả -->
      <div class="single-block">
        <h3 class="sidebar-title">Lọc Theo Giá</h3>
        <ais-numeric-menu
          attribute="price"
          :class-names="{
            'ais-NumericMenu': 'form-check',
            'ais-NumericMenu-list': 'sidebar-menu--shop menu-type-2',
            'ais-NumericMenu-radio': 'form-check-input',
          }"
          :items="[
            { label: 'Tất cả' },
            { label: '<= 10000 đ', end: 10000 },
            { label: '10000đ - 100000đ', start: 10000, end: 100000 },
            { label: '100000đ - 500000đ', start: 100000, end: 500000 },
            { label: '>= 500000đ', start: 500000 },
          ]"
        >
        </ais-numeric-menu>
      </div>
      <!-- Đánh giá -->
      <div class="single-block">
        <h3 class="sidebar-title">Xếp Hạng</h3>
        <ais-rating-menu
          attribute="rating"
          :class-names="{
            'ais-RatingMenu': 'form-check',
            'ais-RatingMenu-starIcon': 'fas fa-star',
            'ais-RatingMenu-starIcon--full': 'fas fa-star star_on',
            'ais-RatingMenu-starIcon--empty': 'fas fa-star',
          }"
        >
        </ais-rating-menu>
      </div>
      <!-- Series -->
      <div class="single-block">
        <h3 class="sidebar-title">Series</h3>
        <ais-refinement-list
          style="max-width: 250px"
          :class-names="{
            'ais-RefinementList-labelText': 'col-2text-truncate',
          }"
          attribute="tseries"
          :limit="10"
          :sort-by="['count:desc']"
          show-more
        >
        </ais-refinement-list>
      </div>
      <!--Tags -->
      <div class="single-block">
        <h3 class="sidebar-title">Tags</h3>
        <ais-refinement-list
          style="max-width: 250px"
          :class-names="{
            'ais-RefinementList-labelText': 'col-2text-truncate',
          }"
          attribute="_tags"
          :limit="10"
          :sort-by="['count:desc']"
          show-more
        />
      </div>
      <!-- Author -->
      <div class="single-block">
        <h3 class="sidebar-title">Tác Giả</h3>
        <ais-refinement-list
          style="max-width: 250px"
          :class-names="{
            'ais-RefinementList-labelText': 'col-2text-truncate',
          }"
          attribute="author"
          show-more
        />
      </div>
      <!-- Publisher -->
      <div class="single-block">
        <h3 class="sidebar-title">Nhà Xuất Bản</h3>
        <ais-refinement-list
          style="max-width: 250px"
          :class-names="{
            'ais-RefinementList-labelText': 'col-2text-truncate',
          }"
          attribute="publisher"
          :limit="10"
          :sort-by="['count:desc']"
          show-more
        />
      </div>
      <!-- Suplier -->
      <div class="single-block">
        <h3 class="sidebar-title">Nhà Cung Cấp</h3>
        <ais-refinement-list
          style="max-width: 250px"
          :class-names="{
            'ais-RefinementList-labelText': 'col-2text-truncate',
          }"
          attribute="supplier"
          :limit="10"
          :sort-by="['count:desc']"
          show-more
        />
      </div>
      <!-- Translator -->
      <div class="single-block">
        <h3 class="sidebar-title">Người Dịch</h3>
        <ais-refinement-list
          style="max-width: 250px"
          :class-names="{
            'ais-RefinementList-labelText': 'col-2text-truncate',
          }"
          attribute="translator"
          :limit="10"
          :sort-by="['count:desc']"
          show-more
        />
      </div>
    </div>
    <main class="inner-page-sec-padding-bottom">
      <div class="container">
        <ais-breadcrumb
          :attributes="[
            'categories.level10',
            'categories.level11',
            'categories.level12',
            'categories.level13',
            'categories.level14',
          ]"
        >
          <span slot="rootLabel">Home > Shop</span>
        </ais-breadcrumb>
        <ais-current-refinements
          :included-attributes="[
            'categories',
            'book',
            'author',
            'rating',
            'price',
            'translator',
            'format',
            'publisher',
            'supplier',
            '_tags',
          ]"
        />
        <div class="shop-toolbar with-sidebar mb--30">
          <div class="row align-items-center">
            <ais-stats
              :class-names="{
                'ais-Stats': 'col-xl-4 col-md-4 col-sm-6 mt--10 mt-sm--0',
                'ais-Stats-text': 'toolbar-status',
              }"
            >
              <!-- <p>
                      Page {{ page + 1 }} of {{ nbPages }} with
                      {{ hitsPerPage }} hits per page
                    </p> -->
              <p slot-scope="{ nbHits, processingTimeMS }">
                {{ nbHits }} kết quả trả về trong {{ processingTimeMS }} giây
              </p>
            </ais-stats>
            <ais-hits-per-page
              :items="[
                {
                  label: '8 sản phẩm',
                  value: 8,
                  default: true,
                },
                { label: '16 sản phẩm', value: 16 },
                { label: '20 sản phẩm', value: 20 },
              ]"
              :class-names="{
                'ais-HitsPerPage-select':
                  'form-control nice-select sort-select',
              }"
            />
            <div class="col-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0">
              <ais-sort-by
                :class-names="{
                  'ais-SortBy': 'sorting-selection',
                  'ais-SortBy-select':
                    'form-control nice-select sort-select mr-0',
                }"
                :items="[
                  { value: 'book', label: 'Mặc định' },
                  {
                    value: 'book_price_asc',
                    label: 'Sắp xếp theo giá từ thấp đến cao.',
                  },
                  {
                    value: 'book_price_des',
                    label: 'Sắp xếp theo giá từ cao đến thấp.',
                  },
                ]"
              >
              </ais-sort-by>
            </div>
          </div>
        </div>
        <!-- Top Nava -->
        <div class="shop-toolbar d-none">
          <div class="row align-items-center">
            <ais-stats
              :class-names="{
                'ais-Stats': 'col-xl-4 col-md-4 col-sm-6 mt--10 mt-sm--0',
                'ais-Stats-text': 'toolbar-status',
              }"
            >
              <!-- <p>
                      Page {{ page + 1 }} of {{ nbPages }} with
                      {{ hitsPerPage }} hits per page
                    </p> -->
              <p slot-scope="{ nbHits, processingTimeMS }">
                {{ nbHits }} kết quả trả về trong {{ processingTimeMS }}giây
              </p>
            </ais-stats>
            <ais-hits-per-page
              :items="[
                {
                  label: '8 sản phẩm',
                  value: 8,
                  default: true,
                },
                { label: '16 sản phẩm', value: 16 },
                { label: '20 sản phẩm', value: 20 },
              ]"
              :class-names="{
                'ais-HitsPerPage': 'ol-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0',
                'ais-HitsPerPage-select':
                  'form-control nice-select sort-select',
              }"
            />
            <div class="col-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0">
              <!-- <ais-sort-by
                :items="[
                  { value: 'book', label: 'Featured' },
                  { value: 'book_price_asc', label: 'Price asc.' },
                  { value: 'book_price_des', label: 'Price desc.' },
                ]"
              /> -->
              <ais-sort-by
                :class-names="{
                  'ais-SortBy': 'sorting-selection',
                  'ais-SortBy-select':
                    'form-control nice-select sort-select mr-0',
                  // ...
                }"
                :items="[
                  { value: 'book', label: 'Mặc định' },
                  {
                    value: 'book_price_asc',
                    label: 'Sắp xếp theo giá từ thấp đến cao.',
                  },
                  {
                    value: 'book_price_des',
                    label: 'Sắp xếp theo giá từ cao đến thấp.',
                  },
                ]"
              >
              </ais-sort-by>
            </div>
          </div>
        </div>
        <ais-hits>
          <div
            slot="item"
            slot-scope="{ item, sendEvent }"
            class="
              shop-product-wrap
              with-pagination
              row
              space-db--30
              shop-border
              list
            "
          >
            <div class="col-lg-4 col-sm-6">
              <div class="product-card card-style-list">
                <div class="product-list-content">
                  <div class="card-image" style="max-width: 250px">
                    <a
                      @click="sendEventClick(item)"
                      :href="
                        '/shop/' +
                        (item.slug == '' ? item.book_name : item.slug)
                      "
                    >
                      <img :src="'/' + item.img" :alt="item.book_name" />
                    </a>
                  </div>
                  <div class="product-card--body">
                    <div class="product-header">
                      <a
                        @click="sendEventClick(item)"
                        href="javascript:void(0)"
                        class="author"
                      >
                        <span v-for="(author, key) in item.author" :key="key">
                          {{ (key > 0 ? "&nbsp;- " : " ") + author }}
                        </span>
                      </a>
                      <h3>
                        <a
                          @click="sendEventClick(item)"
                          :href="
                            '/shop/' +
                            (item.slug == '' ? item.book_name : item.slug)
                          "
                          >{{ item.book_name }}</a
                        >
                      </h3>
                    </div>
                    <article>
                      <h2 class="sr-only">Mô tả</h2>
                      <p
                        v-html="
                          truncate(item.description, 250, '.....Xem thêm')
                        "
                      ></p>
                    </article>
                    <div class="price-block" v-if="item.promotion_id">
                      <span class="price">{{
                        (item.price -
                          (item.price * item.promotion.percent) / 100)
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</span>
                      <del class="price-old">{{
                        item.price
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</del>
                      <span class="price-discount"
                        >{{ item.promotion.percent }}%</span
                      >
                    </div>
                    <div class="price-block" v-else>
                      <span class="price">{{
                        item.price
                          | currency("đ", 0, {
                            symbolOnLeft: false,
                            spaceBetweenAmountAndSymbol: true,
                          })
                      }}</span>
                    </div>
                    <div class="rating-block">
                      <span
                        v-for="index in 5"
                        :key="index"
                        :class="[
                          index > item.rating
                            ? 'fas fa-star'
                            : 'fas fa-star star_on',
                        ]"
                      ></span
                      ><b style="margin-left: 20px"
                        >{{ item.rating }}/5 Trên tổng số bình chọn</b
                      >
                    </div>
                    <div class="btn-block">
                      <cart
                        ref="cart"
                        :product="item"
                        v-on:addToCart="sendEventCart(item)"
                      ></cart>
                      <a
                        href="javascript:void(0)"
                        class="card-link"
                        @click="addFavorite(item)"
                        ><i style="color: red" class="fas fa-heart"></i> Thêm
                        vào danh sách yêu thích</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </ais-hits>
        <ais-pagination />
      </div>
    </main>
  </ais-instant-search>
</template>

<script>
import algoliasearch from "algoliasearch/lite";
import cart from "../vendor/add-cart-button.vue";
export default {
  components: { cart },
  data() {
    return {
      searchClient: algoliasearch(
        "K177MITG7W",
        "7ffdbc248bd1211b1bd1696f1d89cfa6"
      ),
      insightsClient: window.aa,
      items: [],
      order_list_id: [],
      order_list_position: [],
    };
  },
  methods: {
    transformItems(items) {
      return items.map((item) => ({
        ...item,
        label: item.label.toUpperCase(),
      }));
    },
    truncate: function (text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
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
    sendEventClick(item) {
      aa("clickedObjectIDs", {
        index: "book",
        eventName: "Product Clicked",
        queryID: item.__queryID,
        objectIDs: [item.book_id],
        positions: [item.__position],
      });
    },
    sendEventCart(data) {
      this.order_list_id.push(data.book_id);
      this.order_list_position.push(data.__position);
      aa("clickedObjectIDs", {
        index: "book",
        eventName: "Cart Added",
        queryID: data.__queryID,
        objectIDs: this.order_list_id,
        positions: this.order_list_position,
      });
    },
    sendEventFilter(type) {
      aa("clickedFilters", {
        index: "book",
        eventName: "Product Filter",
        filters: [type],
      });
    },
  },
};
</script>
<style>
body {
  font-family: sans-serif;
  padding: 1em;
}

.ais-Hits-list {
  margin-top: 0;
  margin-bottom: 1em;
}

.ais-InstantSearch {
  display: grid;
  grid-template-columns: 1fr 4fr;
  grid-gap: 1em;
}

.ais-Hits-item img {
  margin-right: 1em;
}
.hit-name {
  margin-bottom: 0.5em;
}
.hit-description {
  color: #888;
  font-size: 0.8em;
  margin-bottom: 0.5em;
}
</style>