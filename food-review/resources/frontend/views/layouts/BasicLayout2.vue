<template>
  <div class="template-container">
    <!-- Header -->
    <!-- <site-header></site-header> -->
    <div class="content page">
      <div class="container">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
<script type="text/babel">
// import SiteHeader from "./partials/Header.vue";

export default {
  components: {
    // SiteHeader,
  }
};
</script>

