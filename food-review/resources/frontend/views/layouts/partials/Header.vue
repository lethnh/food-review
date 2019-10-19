<template>
  <header>
    <!-- Header desktop -->
    <div class="wrap-menu-header gradient1 trans-0-4">
      <div class="container h-full">
        <div class="wrap_header trans-0-3">
          <!-- Logo -->
          <div class="logo">
            <router-link to="/toppage">
              <img
                src="/images/icon/logo.png"
                alt="IMG-LOGO"
                data-logofixed="/images/icon/logo2.png"
              />
            </router-link>
          </div>

          <!-- Menu -->
          <div class="wrap_menu p-l-0-xl">
            <nav class="menu">
              <ul class="main_menu" style="margin:0px 0px 0px 20px">
                <li>
                  <router-link to="/toppage">Trang chủ</router-link>
                </li>

                <li>
                  <router-link to="/toppage">Quán ăn</router-link>
                </li>
                <li>
                  <router-link to="/timeline">Bài viết</router-link>
                </li>
                <li>
                  <a href="contact.html">Liên hệ</a>
                </li>
              </ul>
            </nav>
          </div>

          <!-- Social -->
          <div class="auth flex-w flex-l-m ml-auto" v-if="userStore.authUser === null">
            <form class="form-search form-inline my-2 my-lg-0 position-relative">
              <input
                class="form-control mr-sm-2"
                type="search"
                placeholder="Tìm kiếm..."
                aria-label="Search"
              />
              <!-- <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="search"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512"
                class="svg-inline--fa fa-search fa-w-16 fa-fw position-absolute"
              >
                <path
                  fill="currentColor"
                  d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"
                  class
                />
              </svg>-->
            </form>
            <router-link to="register" class="btn btn-outline-light">Đăng ký</router-link>
            <router-link to="login" class="m-l-10 btn btn-outline-light">Đăng nhập</router-link>
            <button class="btn-show-sidebar m-l-33 trans-0-4 d-sm-none"></button>
          </div>
          <div class="flex-w ml-auto" v-if="userStore.authUser !== null">
                <form class="form-search form-inline my-2 my-lg-0 position-relative">
              <input
                class="form-control mr-sm-2"
                type="search"
                placeholder="Tìm kiếm..."
                aria-label="Search"
              />
                </form>
            <li class="nav-item dropdown">
              <a
                class="nav-link navbar-avatar"
                data-toggle="dropdown"
                href="#"
                aria-expanded="false"
                data-animation="scale-up"
                role="button"
              >
                <span class="avatar avatar-online">
                  <img src="/images/5.jpg" alt="..." />
                </span>
                <span class="user_name">{{userStore.authUser.user_info.name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" role="menu">
                <router-link to="/profile" class="dropdown-item">
                  <i class="fas fa-user"></i> Thông tin cá nhân
                </router-link>
                <router-link to="/review" class="dropdown-item">
                  <i class="fas fa-plus"></i> Viết bài đánh giá
                </router-link>
                <div class="dropdown-divider" role="presentation"></div>
                <a class="dropdown-item" @click="logout()">
                  <i class="fas fa-power-off"></i> Đăng xuất
                </a>
              </div>
            </li>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
<script>
import { mapState } from "vuex";
import Ls from "../../../js/services/Ls";
import AuthService from "../../../js/services/Auth";
export default {
  methods: {
    logout() {
      AuthService.logout().then(response => {
        Ls.remove("authUser");
        this.$store.dispatch("setUserObject", null);
        this.$router.push({
          name: "toppage"
        });
      });
    }
  },
  computed: mapState(["userStore"])
};
</script>
<style lang="css">
.wrap-menu-header {
  background-color: rgb(16, 11, 17);
}
.form-search svg {
  right: 20px;
}
.form-search input {
  border-color: black;
}
.avatar {
  position: relative;
  display: inline-block;
  width: 40px;
  white-space: nowrap;
  vertical-align: bottom;
  border-radius: 1000px;
  color: white;
}
.avatar img {
  width: 100%;
  max-width: 100%;
  height: auto;
  border: 0 none;
  border-radius: 1000px;
}
.header-fixed .avatar {
  color: #222222;
}
.user_name {
  color: white;
}
.header-fixed .user_name {
  color: #222222 !important;
}

.dropdown-menu .fas {
  width: 1em;
  text-align: center;
  margin-right: 0.5em;
}
</style>