<template>
  <div class="template-container">
    <!-- Header -->
    <site-header></site-header>
    <div class="content page m-t-120">
      <div class="container">
        <router-view></router-view>
      </div>
    </div>
    <site-footer></site-footer>
  </div>
</template>
<script type="text/babel">
import SiteHeader from "./partials/Header.vue";
import SiteFooter from "./partials/Footer";

export default {
  components: {
    SiteHeader,
    SiteFooter,
  }
};
</script>

