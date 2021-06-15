<template>
 <alert :v-models="showAlert" placement="top" duration="3000" type="danger" width="400px" dismissable>
  <span class="icon-info-circled alert-icon-float-left"></span>
  <strong>Heads up!</strong>
  <p>This alert needs your attention.</p>
</alert>
</template>

<script>
import { alert } from "vue-strap";
Vue.component('alert',alert);
export default {
  component: {
    alert,
  },
  props: [],
  data() {
    return {
        showAlert:true
    };
  },
  mounted() {},
};
</script>

<style>
</style>