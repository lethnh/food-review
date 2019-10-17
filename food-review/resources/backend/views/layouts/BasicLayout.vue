<template>
  <div class="template-container">
    <slide-bar></slide-bar>
    <div class="content page">
      <div class="container m-b-50">
        <router-view></router-view>
      </div>
    </div>
    <!-- Footer -->
    <!-- <site-footer></site-footer> -->
  </div>
</template>
<script>
import SlideBar from "../layouts/partials/SildeBar";

export default {
  components: {
      SlideBar
  }
};
</script>