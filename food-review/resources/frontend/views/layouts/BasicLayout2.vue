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
import { mapState } from "vuex";
import Ls from '../../js/services/Ls'
import SiteFooter2 from "./partials/Footer2.vue";

export default {
  components: {
    SiteFooter2
  },
  created() {
    let authUser = Ls.get("authUser");
    const userObj = JSON.parse(authUser);
    this.$store.dispatch("setUserObject", userObj);
  },
  computed: mapState(["userStore"])
};
</script>
<style lang="css" scoped>
</style>

