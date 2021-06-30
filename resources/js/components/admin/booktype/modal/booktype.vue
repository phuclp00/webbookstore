<template>
  <modal
    ref="childmodal"
    id="childmodal"
    name="formator_detail"
    @closed="hideModal"
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
              <h4 class="card-title mb-0">Book Types Information Preview</h4>
            </div>
            <div class="iq-card-body pb-0">
              <div class="description-contens align-items-top row">
                <div class="col-md-12">
                  <div class="row">
                    <!-- Content -->
                    <div class="col-md">
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
                            {{ data.name }}
                          </h3>
                          <span
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
                      class="
                        iq-card-header
                        d-flex
                        justify-content-between
                        align-items-center
                        position-relative
                      "
                    ></div>
                    <div class="iq-header-title">
                      <h3 class="card-title mb-0">
                        The Books Belong To The Book Types: {{ data.name }}
                      </h3>
                    </div>
                    <b-overlay :show="this.show" rounded="sm">
                      <div class="iq-card-body">
                        <div class="row" v-if="this.list.length > 0">
                          <div
                            v-for="item in list"
                            :key="item.book_id"
                            class="col-sm-6 col-md-4 col-lg-3"
                          >
                            <div
                              class="
                                iq-card
                                iq-card-block
                                iq-card-stretch
                                iq-card-height
                                browse-bookcontent
                              "
                            >
                              <div class="iq-card-body p-0">
                                <div class="d-flex align-items-center">
                                  <div
                                    class="
                                      col-6
                                      p-0
                                      position-relative
                                      image-overlap-shadow
                                    "
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
                                          | currency("đ", 0, {
                                            symbolOnLeft: false,
                                            spaceBetweenAmountAndSymbol: true,
                                          })
                                      }}</span>
                                      <h6>
                                        <b>{{
                                          item.promotion_price
                                            | currency("đ", 0, {
                                              symbolOnLeft: false,
                                              spaceBetweenAmountAndSymbol: true,
                                            })
                                        }}</b>
                                      </h6>
                                    </div>
                                    <div
                                      v-else
                                      class="price align-items-center"
                                    >
                                      <h6>
                                        <span>
                                          <b>{{
                                            item.price
                                              | currency("đ", 0, {
                                                symbolOnLeft: false,
                                                spaceBetweenAmountAndSymbol: true,
                                              })
                                          }}</b>
                                        </span>
                                      </h6>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div v-else>
                          <p>{{ mess }}</p>
                        </div>
                      </div>
                    </b-overlay>
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
      show: true,
      list: [],
      mess: "",
    };
  },
  methods: {
    show_model: function (item) {
      this.$modal.show("formator_detail");
      this.loading_books(item.id);
      return (this.data = item);
    },
    moment: function () {
      return moment();
    },
    hideModal() {
      return (this.list = []), (this.show = true), (this.mess = "");
    },
    loading_books(id) {
      this.get_list_books(id);
      setTimeout(() => {
        this.show = false;
      }, 1000);
    },
    get_list_books(id) {
      console.log("Loading ......");
      axios
        .get("../admin/category/" + id)
        .then((response) => {
          this.list = response.data;
          console.log("Done");
        })
        .catch((err) => {
          this.mess = "NOT FOUND";
        });
    },
  },
};
</script>

<style >
</style>