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
                src="/images/icon/logo2.png"
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
                  <router-link to="/toppage">Quán ăn</router-link>
                </li>
                <li>
                  <router-link to="/timeline">Bài viết</router-link>
                </li>
                <li>
                  <a href="contact.html">Về chúng tôi</a>
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
            </form>
            <router-link to="register" class="btn btn-primary">Đăng ký</router-link>
            <router-link to="login" class="m-l-10 btn btn-success">Đăng nhập</router-link>
            <button class="btn-show-sidebar m-l-33 trans-0-4 d-sm-none"></button>
          </div>
          <div class="flex-w ml-auto" v-if="userStore.authUser !== null">
            <form
              class="form-search form-inline my-2 my-lg-0 position-relative"
              v-on:submit.prevent="passingValue()"
            >
              <input
                class="form-control mr-sm-2"
                style="height:34px;padding-right: 36px;"
                type="search"
                placeholder="Tìm kiếm..."
                v-model="searchText"
                aria-label="Search"
              />
              <i class="fas fa-search text-custom" aria-hidden="true"></i>
              <!-- <a-select
                style="width: 150px"
                class="mr-2"
                placeholder="Chọn tỉnh thành"
                @change="handleProvinceChange"
              >
                <a-select-option v-for="province in citiesData" :key="province.id">{{province.name}}</a-select-option>
              </a-select>-->
            </form>
            <!-- <button class="text-custom">
              <i class="fas fa-search text-white" style="font-size:15px"></i>
            </button>-->
            <!-- <form class="form-inline md-form form-sm active-cyan-2 mt-2">
              <input
                v-if="isShow"
                class="form-control form-control-sm mr-3 w-75"
                type="text"
                placeholder="Search"
                aria-label="Search"
                style="border: none;
    border-bottom: 1px solid #ced4da;"
              />
              <i class="fas fa-search text-custom text-white" @click="show" aria-hidden="true"></i>
            </form>-->
            <li class="nav-item dropdown">
              <a
                class="nav-link navbar-avatar d-flex align-items-center"
                data-toggle="dropdown"
                href="#"
                aria-expanded="false"
                data-animation="scale-up"
                role="button"
              >
                <span class="avatar avatar-online">
                  <img
                    v-if="userStore.authUser.user_info.avatar !== null"
                    :src="userStore.authUser.user_info.avatar"
                    alt="..."
                  />
                  <img v-else src="/images/5.jpg" alt="..." />
                </span>
                <div class="user_name">{{userStore.authUser.user_info.name}}</div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <router-link to="/profile" class="dropdown-item">
                  <i class="fas fa-user"></i> Thông tin cá nhân
                </router-link>
                <router-link to="/review" class="dropdown-item">
                  <i class="fas fa-plus"></i> Viết bài đánh giá
                </router-link>
                <router-link to="/forgot-password" class="dropdown-item">
                  <i class="fas fa-cog" aria-hidden="true"></i>Đổi mật khẩu
                </router-link>
                <div class="dropdown-divider" role="presentation"></div>
                <a class="dropdown-item" @click="logout()">
                  <i class="fas fa-sign-out-alt"></i> Đăng xuất
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
import CityService from "../../../js/services/City";
export default {
  data() {
    return {
      searchText: "",
      city_id: null,
      citiesData: {}
    };
  },
  mounted() {
    this.getCities();
  },
  methods: {
    getCities() {
      CityService.getCities().then(response => {
        // if (response.status === 200) {
        this.citiesData = response;
        // this.districtsData = districts;
        // }
      });
    },
    passingValue() {
      this.$router.push({
        name: "resultSearch",
        query: {
          searchText: this.searchText,
          city_id: this.city_id !== null ? this.city_id : "null"
        }
      });
      // this.location.reload();
      // Post.listPost({ city_id: this.city_id, title: this.title }).then(
      //   response => {
      //     this.posts = response;
      // }
      // );
    },
    logout() {
      AuthService.logout().then(response => {
        Ls.remove("authUser");
        this.$store.dispatch("setUserObject", null);
        this.$router.push("toppage");
      });
    },
    handleProvinceChange(value) {
      this.city_id = value;
      this.passingValue();
    },
    scroll() {
      window.scroll({
        top: 100,
        behavior: "smooth"
      });
    }
  },
  computed: mapState(["userStore"])
};
</script>
<style lang="css">
.wrap-menu-header {
  color: #222222;
  background-color: white;
  /* background-image: linear-gradient(250deg, #dd512a, #ff734c); */
}
.form-search svg {
  right: 20px;
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
  height: 40px;
  border: 0 none;
  border-radius: 1000px;
}
.header-fixed .avatar {
  color: #222222;
}
.header-fixed .text-custom {
  color: black !important;
}
.text-custom {
  position: absolute;
  right: 20px;
}
.user_name {
  color: #222222;
  margin-left: 10px;
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