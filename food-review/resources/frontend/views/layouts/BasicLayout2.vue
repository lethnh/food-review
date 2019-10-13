<template>
  <div class="template-container">
    <!-- Header -->
    <!-- <site-header></site-header> -->
    <div class="content page">
      <div class="container">
        <router-view></router-view>
        <!-- <site-footer2></site-footer2> -->
      </div>
    </div>
  </div>
</template>
<script type="text/babel">
import SiteFooter2 from "./partials/Footer2.vue";

export default {
  components: {
    SiteFooter2
  }
};
</script>
<style lang="css" scoped>

</style>

