<template>
  <div class="template-container">
    <div class="page">
        <router-view></router-view>
    </div>
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