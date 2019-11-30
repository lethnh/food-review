<template>
  <div class="template-container">
    <slide-header></slide-header>
    <slide-bar></slide-bar>
    <div class="page">
        <router-view></router-view>
    </div>
    <!-- Footer -->
    <site-footer></site-footer>
  </div>
</template>
<script>
import SlideBar from "../layouts/partials/SildeBar";
import SlideHeader from "../layouts/partials/Heder";

export default {
  components: {
    SlideBar,
    SlideHeader
  }
};
</script>