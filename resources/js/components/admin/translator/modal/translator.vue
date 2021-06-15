<template>
  <modal
    ref="childmodal"
    name="translator_detail"
    :scrollable="true"
    :height="'auto'"
    :width="'80%'"
    :style="'z-index:1000'"
  >
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
            <div
              class="iq-card-header d-flex justify-content-between align-items-center"
            >
              <h4 class="card-title mb-0">Translator Information Preview</h4>
            </div>
            <div class="iq-card-body pb-0">
              <div class="description-contens align-items-top row">
                <div class="col-md-12">
                  <div class="row">
                    <!-- Image -->
                    <div class="col-md-4">
                      <div
                        class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height"
                      >
                        <div class="row align-items-center">
                          <div class="col">
                            <ul id="description-slider">
                              <!-- Main image -->
                              <li>
                                <a href="javascript:void(0);">
                                  <img
                                    v-if="
                                      data.image == null ||
                                      data.image == 'undefined'
                                    "
                                    src="/images/books/default.jpg"
                                    alt="Book Image"
                                  />
                                  <img
                                    v-else
                                    :src="'/' + data.image"
                                    class="img-fluid w-100 rounded"
                                    alt=""
                                  />
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Content -->
                    <div class="col-md-8">
                      <div
                        class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height"
                      >
                        <div class="iq-card-body p-0">
                          <p style="text-align: right">
                            <span
                              >Last Modified by:
                              <b>{{
                                data.modified_by == null
                                  ? data.created_by
                                  : data.modified_by
                              }}</b></span
                            >,
                            <span>
                              <b>
                                At :{{
                                  moment(data.modified_at).format(
                                    "YYYY/MM/DD H:mm:ss a"
                                  )
                                }}</b
                              ></span
                            >
                          </p>
                          <p
                            v-if="data.deleted_at != null"
                            class="iq-card-body p-1 text-danger"
                          >
                            <span
                              >Deleted by: <b>{{ data.deleted_by }}</b></span
                            >,
                            <span
                              >At :
                              <b>{{
                                moment(data.deleted_at).format(
                                  "YYYY/MM/DD H:mm:ss a"
                                )
                              }}</b></span
                            >
                          </p>
                          <h3 class="mb-3">
                            {{ data.name }}
                          </h3>
                          <span
                            style="text-align: left"
                            class="text-dark mb-4 pb-4 iq-border-bottom d-block"
                            v-html="data.description"
                          ></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div
                    class="iq-card iq-card-block iq-card-stretch iq-card-height"
                  >
                    <div
                      class="iq-card-header d-flex justify-content-between align-items-center position-relative"
                    ></div>
                    <div class="iq-header-title">
                      <h3 class="card-title mb-0">
                        The Books Belong To The Translator: {{ data.name }}
                      </h3>
                    </div>
                    <div class="iq-card-body">
                      <div class="row" v-if="data.books.length > 0">
                        <div
                          v-for="item in data.books"
                          :key="item.book_id"
                          class="col-sm-6 col-md-4 col-lg-3"
                        >
                          <div
                            class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent"
                          >
                            <div class="iq-card-body p-0">
                              <div class="d-flex align-items-center">
                                <div
                                  class="col-6 p-0 position-relative image-overlap-shadow"
                                >
                                  <a href="javascript:void();"
                                    ><img
                                      v-if="item.img != null"
                                      class="img-fluid rounded w-100"
                                      :src="'/' + item.img"
                                      alt=""
                                    /><img
                                      v-else
                                      class="img-fluid rounded w-100"
                                      src="/images/books/default.jpg"
                                      alt=""
                                    />
                                  </a>
                                  <div class="view-book">
                                    <a
                                      href="/admin/books"
                                      class="btn btn-sm btn-white"
                                      >View Book</a
                                    >
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="mb-2">
                                    <h5 class="mb-1">{{ item.book_name }}</h5>
                                    <p class="font-size-13 line-height mb-1">
                                      {{ item.book }}
                                    </p>
                                    <div class="d-block line-height">
                                      <span class="font-size-11 text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                      </span>
                                    </div>
                                  </div>
                                  <div
                                    v-if="item.promotion_price != null"
                                    class="price d-flex align-items-center"
                                  >
                                    <span class="pr-1 old-price">{{
                                      item.price
                                    }}</span>
                                    <h6>
                                      <b>{{ item.promotion_price }}</b>
                                    </h6>
                                  </div>
                                  <div
                                    v-else
                                    class="price d-flex align-items-center"
                                  >
                                    <h6>
                                      <b>{{ item.price }}</b>
                                    </h6>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div v-else>
                        <p>Oops! There are no books in {{ data.name }} !!</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </modal>
</template>

<script>
import moment from "moment";
export default {
  props: ["detail"],
  data() {
    return {
      data: this.detail,
      index: 1,
    };
  },
  methods: {
    show_model: function (item) {
      this.$modal.show("translator_detail");
      return (this.data = item);
    },
    moment: function () {
      return moment();
    },
  },
};
</script>

<style scoped>
</style>