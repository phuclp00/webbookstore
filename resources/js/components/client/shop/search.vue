<template>
  <div>
    <ais-instant-search
      index-name="book"
      :search-client="searchClient"
      :insights-client="insightsClient"
    >
      <ais-configure clickAnalytics="true" :analytics="true" />
      <ais-index index-name="book" />
      <ais-autocomplete>
        <div slot-scope="{ currentRefinement, indices, refine, sendEvent }">
          <input
            type="search"
            :value="currentRefinement"
            placeholder="Search for a product"
            @input="refine($event.currentTarget.value)"
          />
          <ul
            class="box-result"
            v-if="currentRefinement"
            v-for="(index, key) in indices"
            :key="key"
          >
            <li class="text-center">
              <h3>Kết quả hiển thị cho :{{ currentRefinement }}</h3>
              <ais-stats>
                <p slot-scope="{ nbHits, processingTimeMS, query }">
                  Tìm thấy {{ nbHits }} kết quả trong
                  {{ processingTimeMS }} giây
                </p>
              </ais-stats>
            </li>
            <li v-for="(hit, key) in index.hits" :key="key">
              <div class="m-md-5">
                <b-card
                  @click="sendEventSearch(index, hit)"
                  :img-src="'/' + hit.img"
                  :img-alt="hit.book_name"
                  style="height: 17rem"
                  img-left
                  class="mb-3"
                >
                  <b-card-text>
                    <a
                      href="javascript:void(0)"
                      class="h2"
                      @click="sendEventSearch(index, hit)"
                      ><ais-highlight attribute="book_name" :hit="hit"
                    /></a>
                    <div>
                      <span
                        v-html="truncate(hit.description, 150, '....')"
                      ></span>
                    </div>
                  </b-card-text>
                </b-card>
              </div>
            </li>
          </ul>
        </div>
      </ais-autocomplete>
    </ais-instant-search>
  </div>
</template>

<script>
import algoliasearch from "algoliasearch/lite";
import { history } from "instantsearch.js/es/lib/routers";
import { simple } from "instantsearch.js/es/lib/stateMappings";
export default {
  data() {
    return {
      searchClient: algoliasearch(
        "K177MITG7W",
        "7ffdbc248bd1211b1bd1696f1d89cfa6"
      ),
      insightsClient: window.aa,

      routing: {
        router: history(),
        stateMapping: simple(),
      },
      active: false,
      text: "",
    };
  },
  mounted() {},
  computed: {
    showbox() {
      return this.text.length > 0
        ? (this.active = true)
        : (this.active = false);
    },
  },
  methods: {
    truncate: function (text, length, suffix) {
      if (text.length > length) {
        return text.substring(0, length) + suffix;
      } else {
        return text;
      }
    },
    sendEventSearch(item, hit) {
      let id = [];
      let position = [];
      item.hits.forEach((data, key) => {
        id.push(data.book_id);
        position.push(key);
      });

      aa("clickedObjectIDsAfterSearch", {
        index: "book",
        eventName: "Product Search",
        queryID: item.results.queryID,
        objectIDs: id,
        positions: position,
      });
      console.log(hit);
      return (window.location.href = "/shop/" + hit.book_name);
    },
  },
};
</script>

<style>
.box-result {
  position: absolute;
  overflow: auto;
  height: auto;
  width: 700px;
  z-index: 1000;
  background: white;
  max-height: 800px;
  left: -126px;
  border: 1px solid #28a745;
  border-radius: 10px;
  margin: 20px;
}
</style>