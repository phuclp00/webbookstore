<template>
  <modal
    ref="childmodal"
    name="author_detail"
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
              <h4 class="card-title mb-0">Author Information Preview</h4>
            </div>
            <div class="iq-card-body pb-0">
              <div class="description-contens align-items-top row">
                <div class="col-md-12">
                  <div class="row">
                    <!-- Image -->
                    <div class="col-md-4">
                      <div
                        class="
                          iq-card-transparent
                          iq-card-block
                          iq-card-stretch
                          iq-card-height
                        "
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
                                    class="img-fluid w-100 rounded"
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
                            style="text-align: left"
                            class="text-dark mb-4 pb-4 iq-border-bottom d-block"
                            v-html="data.description"
                          ></span>
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
      <book
        v-if="book != null"
        name="books"
        :detail="book"
        ref="reference"
      ></book>
    </div>
  </modal>
</template>

<script>
import moment from "moment";
import book from "../../book/modal/book_detail.vue";
export default {
  props: ["detail"],
  components: { book },
  data() {
    return {
      data: this.detail,
      index: 1,
      book: [],
    };
  },
  methods: {
    show_model: function (item) {
      this.$modal.show("author_detail");
      return (this.data = item);
    },
    moment: function () {
      return moment();
    },
    showModal(item) {
      this.book = item;
      this.$refs.reference.show_model(item);
    },
  },
};
</script>

<style scoped>
</style>