<template>
  <div>
    <span class="font-weight-bold">
      Xin Chào <br />
      {{ user.user_name }}
    </span>
  </div>
</template>
<script>
export default {
  props: ["user"],
  data() {
    return {
      unreadNotifications: [],
    };
  },
  mounted() {
    Echo.private("App.Models.UserModel." + this.user.user_id).notification(
      (notification) => {
        this.$root.makeToast("success", notification.notifiable.data.data);
      }
    );
  },
  computed: {},
};
</script>

<style>
</style>