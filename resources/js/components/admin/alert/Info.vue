<template></template>
<script>
export default {
  components: {
    alert,
  },
  props: ["user"],
  data() {
    return {
      showAlert: false,
      notification: null,
      duration: 2000,
    };
  },
  computed: {
    show() {
      return this.showAlert;
    },
  },
  mounted() {
    Echo.private("App.Models.UserModel." + this.user).notification(
      (notification) => {
        // this.showAlert = !this.showAlert;
        this.notification = notification.notifiable;
        this.makeToast("success", this.notification.data.data);
      }
    );
  },
  methods: {
    makeToast(variant = null, mess) {
      this.$bvToast.toast(mess, {
        title: "Messege feeback :",
        variant: variant,
        solid: true,
      });
    },
  },
};
</script>

<style scoped>
.alert {
  display: flow-root;
}
</style>