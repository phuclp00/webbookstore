
<template>
  <div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
      <div class="iq-header-title">
        <h4 class="card-title">User List</h4>
      </div>
    </div>
    <div class="table-responsive">
      <table
        id="datatable"
        class="table table-bordered table-responsive-md table-striped text-center"
        role="grid"
        aria-describedby="user-list-page-info"
      >
        <thead class="thead-light">
          <tr id="user_list_header">
            <th>STT</th>
            <th>Profile</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Status</th>
            <th>Join Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in tableData" :key="user.user_id">
            <td>{{ user.user_id }}</td>
            <td class="text-center">
              <img
                v-if="user.user_detail.img != null"
                class="rounded img-fluid avatar-40"
                :src="'../images/user_profile/'.user.user_detail.img"
                alt="profile"
              />
              <img
                v-else
                class="rounded img-fluid avatar-40"
                :src="'../images/users/user_default.svg'"
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
                v-if="user.user_detail.phone != null"
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
              <a
                href="#"
                v-if="user.status == 0"
                class="badge iq-bg-danger option"
                @click="changeStatus(user)"
              >
                BAN
              </a>
              <a
                href="#"
                v-else
                class="badge iq-bg-info option"
                @click="changeStatus(user)"
              >
                ACTIVE
              </a>
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
                  data-original-title="Detail"
                  href="#"
                  ><i class="ri-user-add-line"></i
                ></a>
                <a
                  class="iq-bg-primary option-edit"
                  data-toggle="tooltip"
                  data-placement="top"
                  title=""
                  data-original-title="Edit"
                  href="#"
                  ><i class="ri-pencil-line"></i
                ></a>
                <a
                  class="iq-bg-primary option-delete"
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
            <th width="5%">Profile</th>
            <th width="15%">User Name</th>
            <th width="10%">Email</th>
            <th width="15%">Contact</th>
            <th width="20%">Address</th>
            <th width="10%">Status</th>
            <th width="15%">Join Date</th>
            <th width="10%">Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: ["userlist"],
  data() {
    return {
      tableData: [],
      isHidden: false,
    };
  },
  methods: {
    datetime(date) {
      return moment(date, "YYYY-MM-DD").format("DD/MM/YYYY");
    },
    timeago(date) {
      return moment(date).startOf("hours").fromNow();
    },
    showAddress(user) {
      if (user.user_detail.street == null) {
        return "This user has not updated the information yet	";
      } else
        return (
          user.user_detail.street +
          " ," +
          user.user_detail.district +
          " ," +
          user.user_detail.city
        );
    },
    changeStatus(user) {
      axios
        .get("../change-status-user/" + user.user_id + "/" + user.status)
        .then((response) => {
          this.tableData = response.data;
        });
    },
  },
  mounted() {
    this.tableData = this.userlist;
  },
  created() {
    $(document).ready(function () {
      $.noConflict();
      $("#datatable").DataTable({
        dom: "Bfrtip",
        buttons: [
          {
            extend: "copyHtml5",
            exportOptions: {
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
            },
            className: " btn-outline-primary",
            text: "Copy to clipboard",
            key: {
              key: "C",
              altkey: true,
            },
            titleAttr: "Press C on the keyboard or click into to Copy ",
          },
          {
            extend: "excelHtml5",
            className: " btn-outline-primary",
            exportOptions: {
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
            },
            text: "Export to Excel",
            key: {
              key: "E",
              altkey: true,
            },
            titleAttr: "Press E on the keyboard or click into to Export ",
          },
          {
            extend: "pdfHtml5",
            exportOptions: {
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
            },
            className: " btn-outline-primary",
            text: "Export to PDF",
            key: {
              key: "D",
              altkey: true,
            },
            download: "open",
            titleAttr: "Press D on the keyboard or click into to Export ",
          },
          {
            extend: "csvHtml5",
            exportOptions: {
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
            },
            className: " btn-outline-primary",
            text: "Export to CSV",
            key: {
              key: "V",
              altkey: true,
            },
            titleAttr: "Press V on the keyboard or click into to Export ",
          },
          {
            extend: "print",
            exportOptions: {
              columns: [0, 2, 3, 4, 5, 6, 7, 8, 9],
            },
            className: "buttons-html5 btn-outline-primary",
            text: "Print",
            key: {
              key: "p",
              altkey: true,
            },
            titleAttr: "Press P on the keyboard or click into to print",
          },
        ],
      });
    });
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
