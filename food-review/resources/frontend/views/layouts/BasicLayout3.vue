<template>
  <div class="template-container">
    <!-- Header -->
    <site-header></site-header>
    <div class="content page p-t-120">
      <div class="container">
        <router-view></router-view>
      </div>
    </div>
    <site-footer></site-footer>
  </div>
</template>
<script type="text/babel">
import { mapState } from "vuex";
import Ls from '../../js/services/Ls'
import SiteHeader from "./partials/Header.vue";
import SiteFooter from "./partials/Footer";

export default {
  components: {
    SiteHeader,
    SiteFooter
  },
  created() {
    let authUser = Ls.get("authUser");
    const userObj = JSON.parse(authUser);
    this.$store.dispatch("setUserObject", userObj);
  },
  computed: mapState(["userStore"])
};
</script>

