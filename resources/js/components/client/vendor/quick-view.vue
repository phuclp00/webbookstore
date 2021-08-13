<template>
  <a href="javascript:void(0)" @click="sho" data-toggle="modal" data-target="#quickModal" class="single-btn">
    <i class="fas fa-eye"></i>
  </a>
</template>

<script>
import modal from "../product/modal.vue";
export default {
  components: { modal },
  data() {
    return {

    };
  },
};
</script>

<style>
</style>