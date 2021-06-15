<template>
  <modal
    ref="childmodal"
    name="book_detail"
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
              class="
                iq-card-header
                d-flex
                justify-content-between
                align-items-center
              "
            >
              <h4 class="card-title mb-0">Books Information Preview</h4>
            </div>
            <div class="iq-card-body pb-0">
              <div class="description-contens align-items-top row">
                <!-- Image & Thumb -->
                <div class="col-md-4">
                  <div
                    class="
                      iq-card-transparent
                      iq-card-block
                      iq-card-stretch
                      iq-card-height
                    "
                    style="text-align: center"
                  >
                    <div class="iq-card-body p-0">
                      <div class="row">
                        <div class="col">
                          <ul id="description-slider">
                            <!-- Main image -->
                            <li>
                              <a href="javascript:void(0);">
                                <img
                                  v-if="data.img == null"
                                  src="/images/books/default.jpg"
                                  alt="Book Image"
                                />
                                <img
                                  v-else
                                  :src="'/' + data.img"
                                  class="img-fluid w-100 rounded"
                                  alt=""
                                />
                              </a>
                            </li>
                            <b-button v-b-toggle.sidebar-1 style="margin: 20px"
                              >Show Thumbnail</b-button
                            >
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Content -->
                <div class="col-md-8">
                  <div
                    class="
                      iq-card-transparent
                      iq-card-block
                      iq-card-stretch
                      iq-card-height
                    "
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
                        <span v-if="data.series == null">{{
                          data.book_name
                        }}</span>
                        <span v-else>
                          {{
                            data.book_name + " - Episode " + data.episode
                          }}</span
                        >
                        <p class="text-danger">
                          (
                          {{
                            data.total == 0
                              ? "Sold Out"
                              : "In Stock: " + data.total
                          }}
                          )
                        </p>
                      </h3>
                      <div
                        class="
                          price
                          d-flex
                          align-items-center
                          font-weight-500
                          mb-2
                        "
                        v-if="data.promotion_price != null"
                      >
                        <span class="font-size-20 pr-2 old-price">{{
                          data.price
                        }}</span>
                        <span class="font-size-24 text-dark">{{
                          data.promotion_price
                        }}</span>
                      </div>
                      <div
                        v-else
                        class="
                          price
                          d-flex
                          align-items-center
                          font-weight-500
                          mb-2
                        "
                      >
                        <span class="font-size-24 text-dark">{{
                          data.price
                        }}</span>
                      </div>
                      <div style="text-align: left">
                        <span
                          class="text-dark mb-4 pb-4 iq-border-bottom d-block"
                          v-html="data.description"
                        ></span>
                        <!-- Rating -->
                        <div class="mb-3 d-block">
                          <span class="text-primary mb-4">Rating :</span>
                          <span class="font-size-20 text-warning">
                            <i class="fa fa-star mr-1"></i>
                            <i class="fa fa-star mr-1"></i>
                            <i class="fa fa-star mr-1"></i>
                            <i class="fa fa-star mr-1"></i>
                            <i class="fa fa-star"></i>
                          </span>
                        </div>
                        <hr />
                        <div class="text-primary mb-4">
                          Author:
                          <span v-if="data.author != null" class="text-body">{{
                            data.author.name
                          }}</span>
                          <span v-else class="text-body"
                            >This category is being updated</span
                          >
                        </div>
                        <div class="text-primary mb-4">
                          Barcode:
                          <span class="text-body">{{ data.serialNumber }}</span>
                        </div>
                        <div class="text-primary mb-4">
                          Book Category:
                          <span
                            v-if="data.category != null"
                            class="text-body"
                            >{{ data.category.cat_name }}</span
                          >
                          <span v-else class="text-body"
                            >This category is being updated</span
                          >
                        </div>
                        <div class="text-primary mb-4">
                          Book Publisher:
                          <span
                            v-if="data.publisher != null"
                            class="text-body"
                            >{{ data.publisher.name }}</span
                          >
                          <span v-else class="text-body"
                            >This publisher is being updated</span
                          >
                        </div>
                        <div class="text-primary mb-4">
                          Book Supplier:
                          <span
                            v-if="data.supplier != null"
                            class="text-body"
                            >{{ data.supplier.name }}</span
                          >
                          <span v-else class="text-body"
                            >This publisher is being updated</span
                          >
                        </div>
                        <div class="text-primary mb-4">
                          Book Size:
                          <span class="text-body">{{ data.size }}</span>
                        </div>
                        <div class="text-primary mb-4">
                          Book Weight:
                          <span class="text-body"
                            >{{ data.weight }} (gram)</span
                          >
                        </div>
                        <div class="text-primary mb-4">
                          CopyRight:
                          <span class="text-body">{{
                            data.copyrightYear
                          }}</span>
                        </div>
                        <div class="text-primary mb-4">
                          Date Published:
                          <span class="text-body">{{
                            data.datePublished
                          }}</span>
                        </div>
                        <div class="text-primary mb-4">
                          Book Format:
                          <span v-if="data.format != null" class="text-body">{{
                            data.format.name
                          }}</span>
                          <span v-else class="text-body"
                            >Book format is being updated</span
                          >
                        </div>
                        <div class="text-primary mb-4">
                          Book Language:
                          <span v-if="data.lang != null" class="text-body">{{
                            data.lang.name
                          }}</span
                          ><span v-else class="text-body"
                            >Book Language is being updated</span
                          >
                        </div>
                        <div class="text-primary mb-4">
                          Book Series:
                          <span v-if="data.series != null" class="text-body">{{
                            data.series.name
                          }}</span>
                          <span v-else class="text-body"
                            >Book Series is being updated</span
                          >
                        </div>
                        <div class="text-primary mb-4">
                          Translator:
                          <span
                            v-if="data.translator != null"
                            class="text-body"
                            >{{ data.translator.name }}</span
                          >
                          <span v-else class="text-body"
                            >Translator is being updated</span
                          >
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
    </div>
    <b-sidebar
      id="sidebar-1"
      title="Book Thumbnail Preview"
      shadow
      width="400px"
    >
      <div class="text-xxl-center" v-if="data.thumb == null">
        This book don't have any thumbnail available !
      </div>
      <div v-else class="px-3 py-2" v-for="index in data.thumb" :key="index.id">
        <b-img
          :src="'/' + index.image"
          :alt="index.description"
          fluid
          thumbnail
        ></b-img>
      </div>
    </b-sidebar>
  </modal>
</template>

<script>
import moment from "moment";
export default {
  props: ["detail"],
  data() {
    return {
      data: this.detail,
    };
  },
  methods: {
    show_model: function (item) {
      this.$modal.show("book_detail");
      return (this.data = item);
    },

    moment: function () {
      return moment();
    },
  },
};
</script>

<style>
ul {
  list-style: none;
}
</style>