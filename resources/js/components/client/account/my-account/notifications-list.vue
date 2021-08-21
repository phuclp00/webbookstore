<template>
  <div class="myaccount-content">
    <h3>Thông Báo</h3>
    <div class="welcome mb-20">
      <p>
        Xin chào, <strong>{{ user.user_name }}</strong>
      </p>
      <p>
        <span>Thứ hạng hiện tại của bạn là :</span
        ><b>{{ user.membership.type }}</b>
      </p>
      <p>
        <span>Tổng số tiền mua hàng đã chi trả : </span
        ><b>{{ total_used | currency("VND", 0, { symbolOnLeft: false }) }}</b>
      </p>
      <p>
        <span>
          Điểm hiện có :
          {{ user.points.length > 0 ? user.points[0].reward_points : 0 }} điểm
        </span>
      </p>
    </div>
    <p class="mb-0">
      Bạn đang có
      <span class="text-danger">{{ unreadNotifications.length }}</span>
      thông báo chưa đọc từ cửa hàng
    </p>
    <b-button variant="success" @click="markAllRead()"
      >Đánh dấu tất cả là đã đọc</b-button
    >
    <hr />
    <div style="max-height: 500px; overflow: auto">
      <b-list-group v-for="(notification, key) in allNotifications" :key="key">
        <b-list-group-item
          href="javascript:void(0)"
          style="margin-bottom: 20px"
          class="flex-column align-items-start"
          :active="unread(notification)"
          @click="marAsRead(notification.id)"
        >
          <div>{{ notification.data.data }}</div>
          <div>{{ datetime(notification.created_at) }}</div>
          <small>{{ timeago(notification.created_at) }}</small>
        </b-list-group-item>
      </b-list-group>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: ["user"],
  data() {
    return {
      allNotifications: [],
      unreadNotifications: [],
      total_used: 0,
    };
  },
  mounted() {
    let id = this.user.user_id;
    Echo.private("App.Models.UserModel." + id).notification((notification) => {
      // this.showAlert = !this.showAlert;
      this.allNotifications.unshift(notification.notifiable);
    });
  },
  watch: {
    allNotifications() {
      this.unreadNotifications = this.allNotifications.filter(
        (notification) => {
          return notification.read_at == null;
        }
      );
    },
  },
  methods: {
    total() {
      axios.get("/my-account/total-used").then((response) => {
        return (this.total_used = response.data.total_used);
      });
    },
    markAllRead() {
      axios
        .get("/my-account/mark-all-read/" + this.user.user_id)
        .then((response) => {
          Vue.nextTick(() => {
            this.unreadNotifications = [];
            this.allNotifications = response.data.notifications;
          });
        });
    },
    marAsRead(id) {
      axios
        .get("/my-account/mark-as-read/" + this.user.user_id + "/" + id)
        .then((response) => {
          return (this.allNotifications = response.data.notifications);
        });
    },
    unread(notifications) {
      return notifications.read_at == null;
    },
    datetime(date) {
      return moment(date, "YYYY-MM-DD").format("DD/MM/YYYY");
    },
    timeago(date) {
      return moment(date).startOf("hours").fromNow();
    },
  },
  created() {
    this.allNotifications = this.user.notifications;
    this.unreadNotifications = this.user.notifications.filter((data) => {
      return data.read_at == null;
    });
    this.total();
  },
};
</script>

<style>
</style>