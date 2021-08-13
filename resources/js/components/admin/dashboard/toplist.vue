<template>
  <div class="col-sm-6">
    <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
      <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
          <h4 class="card-title text-capitalize">
            Top 10 Product Product With Highest {{ type }}
          </h4>
        </div>
      </div>
      <div class="iq-card-body">
        <div class="table-responsive">
          <table class="table mb-0 table-borderless">
            <thead>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Book Name</th>
                <th scope="col">Total View</th>
                <th scope="col">Rating</th>
                <th scope="col">Sales</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(book, key) in books" :key="key">
                <td>{{ key + 1 }}</td>
                <td>{{ book.book_name }}</td>
                <td>
                  <div class="badge badge-pill badge-primary">
                    {{ book.view == null ? 0 : book.view }}
                  </div>
                </td>
                <td>
                  <div class="badge badge-pill badge-warning">
                    {{ book.rate }}/5
                  </div>
                </td>
                <td>
                  <div class="badge badge-pill badge-danger">
                    {{ book.sales == null ? 0 : book.sales }}
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["type"],
  data() {
    return {
      books: [],
    };
  },
  methods: {
    get_list_book() {
      axios.get("/admin/dashboard/" + this.type).then((response) => {
        return (this.books = response.data.data);
      });
    },
  },
  created() {
    this.get_list_book();
  },
};
</script>

<style>
</style>