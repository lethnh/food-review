<template>
  <div class="template-container">
    <!-- Header -->
    <site-header></site-header>
    <silde-bar></silde-bar>
    <div class="content page" style="padding:100px 0px 50px">
      <div class="container">
        <router-view></router-view>
      </div>
    </div>
    <!-- Footer -->
    <site-footer></site-footer>
  </div>
</template>
<script type="text/babel">
import { mapState } from "vuex";
import Ls from "../../js/services/Ls";
import SiteHeader from "./partials/Header.vue";
import SiteFooter from "./partials/Footer";
import SildeBar from "./partials/SlideBar.vue";

export default {
  components: {
    SiteHeader,
    SiteFooter,
    SildeBar
  },
  created() {
    let authUser = Ls.get("authUser");
    const userObj = JSON.parse(authUser);
    this.$store.dispatch("setUserObject", userObj);
  },
  computed: mapState(["userStore"])
};
</script>
