
<template>
  <div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
      <div class="iq-header-title">
        <h4 class="card-title">User List</h4>
      </div>
    </div>
    <div class="table-responsive">
      <Header></Header>
      <table
        id="user-list-table"
        class="table table-striped table-bordered mt-4"
        role="grid"
        aria-describedby="user-list-page-info"
      >
        <thead class="thead-light">
          <tr id="user_list_header">
            <th>Profile</th>
            <th>User Name</th>
            <th>Email</th>
            <th style="width: 250px">Contact</th>
            <th>Address</th>
            <th>Status</th>
            <th>Join Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in tableData" :key="user.user_id">
            <td class="text-center">
              <img
                class="rounded img-fluid avatar-40"
                :src="'../images/user/01.jpg'"
                alt="profile"
              />
            </td>
            <td>{{ user.user_name }}</td>
            <td>
              <a
                href="https://iqonic.design/cdn-cgi/l/email-protection"
                class="__cf_email__"
                :data-cfemail="user.email"
                >[email&#160;protected]
              </a>
            </td>
            <td>
              <a
                v-if="user.user_detail.phone != ''"
                href="https://iqonic.design/cdn-cgi/l/email-protection"
                class="__cf_email__"
                :data-cfemail="user.user_detail.phone"
                >[phone&#160;protected]
              </a>
              <span v-else>This user has not updated the information yet</span>
            </td>
            <td>
              <p v-if="showAddress(user) != null">
                {{ showAddress(user) }}
              </p>
              <span v-else>
                This user has not updated the information yet
              </span>
            </td>
            <td>
              <span v-if="user.status == 'ban'" class="badge iq-bg-danger"
                ><a href="#" @click="changeStatus(user)">{{
                  user.status
                }}</a></span
              >
              <span v-else class="badge iq-bg-info"
                ><a href="#" @click="changeStatus(user)">{{
                  user.status
                }}</a></span
              >
            </td>
            <td>
              <p>
                {{ datetime(user.created_at) }}
              </p>
              <span>{{ timeago(user.created_at) }}</span>
            </td>
            <td>
              <div class="flex align-items-center list-user-action option">
                <a
                  class="iq-bg-primary"
                  data-toggle="tooltip"
                  data-placement="top"
                  title=""
                  data-original-title="Add"
                  href="#"
                  ><i class="ri-user-add-line"></i
                ></a>
                <a
                  class="iq-bg-primary"
                  data-toggle="tooltip"
                  data-placement="top"
                  title=""
                  data-original-title="Edit"
                  href="#"
                  ><i class="ri-pencil-line"></i
                ></a>
                <a
                  class="iq-bg-primary"
                  data-toggle="tooltip"
                  data-placement="top"
                  title=""
                  data-original-title="Delete"
                  href="#"
                  ><i class="ri-delete-bin-line"></i
                ></a>
              </div>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="thead-light">
            <th>Profile</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Status</th>
            <th>Join Date</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <Pagination></Pagination>
  </div>
</template>

<script>
import Pagination from "./DataTablePagination";
import Header from "./DataTableHeader";
import moment from "moment";

// import VueTimeago from "vue-timeago";
// Vue.use(VueTimeago, {
//   name: "Timeago", // Component name, `Timeago` by default
//   locale: "en", // Default locale
//   // We use `date-fns` under the hood
//   // So you can use all locales from it
//   locales: {
//     ja: require("date-fns/locale/ja"),
//   },
// });
export default {
  components: {
    Header,
    Pagination,
  },
  data() {
    return {
      tableData: [],
      isHidden: false,
    };
  },
  methods: {
    getListUser() {
      axios.get("../users-list").then((response) => {
        this.tableData = response.data;
      });
    },
    datetime(date) {
      return moment(date, "YYYY-MM-DD").format("DD/MM/YYYY");
    },
    timeago(date) {
      return moment(date).startOf("hours").fromNow();
    },
    showAddress(user) {
      return (
        user.user_detail.street +
        " ," +
        user.user_detail.district +
        " ," +
        user.user_detail.city
      );
    },
    changeStatus(user) {
      axios.post("../change-status-user/"+user.user_id+"/"+user.status)
        .then((response) => {
          this.tableData=response.data;
        });
    },
  },
  created() {
    this.getListUser();
  },
};
</script>
<style scoped>
td {
  margin: 0 auto;
}
td > span:first-child {
  color: #fd7e14;
}
span {
  color: var(--iq-primary);
}
</style>
