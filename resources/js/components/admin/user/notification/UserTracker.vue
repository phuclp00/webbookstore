<template>
  <li class="nav-item nav-icon">
    <a
      href="#"
      class="search-toggle iq-waves-effect text-gray rounded"
      @click="click"
    >
      <i class="ri-notification-2-line"></i>
      <span class="bg-primary dots"></span>
    </a>
    <div
      ref="dropdown"
      class="iq-sub-dropdown scrolling-auto"
      v-on:scroll.passive="onScroll"
    >
      <div class="iq-card shadow-none m-0">
        <div class="iq-card-body p-0">
          <div class="bg-primary p-3 active">
            <a href="#" @click="markAllRead()">
              <h5 class="mb-0 text-white">
                Check All Notifications
                <small class="badge badge-light float-right pt-1"
                  ><span>{{ unreadNotifications.length }}</span></small
                >
              </h5>
            </a>
          </div>
          <a
            href="#"
            v-for="notification in allNotifications.slice(0, number)"
            class="iq-sub-card"
            :key="notification.id"
            ref="notification"
            @click="marAsRead(notification.id)"
          >
            <div class="media align-items-center">
              <div class="">
                <img
                  class="avatar-40 rounded"
                  :src="'../images/user/01.jpg'"
                  alt=""
                />
              </div>
              <div class="media-body ml-3">
                <h6
                  id="notification"
                  class="mb-0"
                  :class="{
                    'text-success': notification.read_at == null,
                  }"
                >
                  {{ notification.data.data }}
                </h6>
                <small class="float-right font-size-12"
                  ><timeago
                    :datetime="notification.created_at"
                    :auto-update="60"
                  ></timeago
                ></small>
                <p class="mb-0">95 MB</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </li>
</template>
<script>
import VueTimeago from "vue-timeago";
Vue.use(VueTimeago, {
  name: "Timeago", // Component name, `Timeago` by default
  locale: "en", // Default locale
  // We use `date-fns` under the hood
  // So you can use all locales from it
  locales: {
    ja: require("date-fns/locale/ja"),
  },
});
export default {
  props: ["user", "unreads"],
  data() {
    return {
      allNotifications: [],
      unreadNotifications: [],
      number: 5,
    };
  },
  mounted() {},
  methods: {
    markAllRead() {
      axios.get("../mark-all-read/" + this.user.user_id).then((response) => {
        this.unreadNotifications = [];
        this.allNotifications = response.data.notifications;
      });
    },
    onScroll(event) {
      if (this.number == this.allNotifications.length) {
        return;
      }
      return (this.number += 2);
    },
    click(event) {
      this.$refs.dropdown.scrollTop = true;
    },
    marAsRead(id) {
      axios
        .get("../mark-as-read/" + this.user.user_id + "/" + id)
        .then((response) => {
          this.allNotifications = response.data.notifications;
        });
    },
  },
  watch: {
    allNotifications(val) {
      this.unreadNotifications = this.allNotifications.filter(
        (notification) => {
          return notification.read_at == null;
        }
      );
    },
  },

  created() {
    document.addEventListener("scroll", this.onScroll);
    document.addEventListener("click", this.click);
    this.allNotifications = this.user.notifications;

    this.unreadNotifications = this.allNotifications.filter((notification) => {
      return notification.read_at == null;
    });

    Echo.private("App.Models.UserModel." + this.user.user_id).notification(
      (notification) => {
        this.allNotifications.unshift(notification.notifiable);
      }
    );
  },
  destroyed() {
    document.removeEventListener("scroll", this.onScroll);
    document.removeEventListener("click", this.click);
  },
};
</script>
<style scoped>
.scrolling-auto {
  overflow-x: hidden;
  overflow-y: scroll;
  height: 450px;
}
.active {
  position: -webkit-sticky; /* Safari & IE */
  position: sticky;
  top: 0;
  z-index: 1;
}
</style>