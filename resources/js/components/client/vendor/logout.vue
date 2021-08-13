<template>
  <a href="javascript:void(0)" @click="logout()">
    <slot name="icon"></slot>Đăng Xuất</a
  >
</template>

<script>
export default {
  props: ["class_custome"],
  methods: {
    logout() {
      axios.post("/my-account/logout").then((response) => {
        Vue.nextTick(() => {
          window.location.href = "/";
        });
      });
    },
  },
};
</script>

<style>
</style>