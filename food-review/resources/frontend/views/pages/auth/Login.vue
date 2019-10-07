<template>
  <div class="limiter">
    <!-- <TravelMap class="travel-map" /> -->
    <div class="container-login100 flex-column">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54 shadow">
        <form class="login100-form validate-form">
          <span class="login100-form-title p-b-49">
            <!-- Logo -->
            <router-link to="/">
              <img src="/images/icon/logo2.png" alt="IMG-LOGO" />
            </router-link>
            <!-- End logo -->
          </span>
          <!-- Email -->
          <div class="m-b-23">
            <label class="label-input100">Email</label>
            <ValidationProvider name="email" rules="required|email">
              <div slot-scope="{ errors }">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                  </div>
                  <input type="email" v-model="loginData.email" class="form-control border" />
                </div>
                <small class="color0">{{ errors[0] }}</small>
              </div>
            </ValidationProvider>
          </div>
          <!-- End Email -->
          <!-- Password -->
          <div class>
            <label class="label-input100">Mật khẩu</label>
            <ValidationProvider name="password" rules="required|min:3">
              <div slot-scope="{ errors }">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                  </div>
                  <input type="email" v-model="loginData.password" class="form-control border" />
                </div>
                <small class="color0">{{ errors[0] }}</small>
              </div>
            </ValidationProvider>
          </div>
          <!-- End Password -->
          <!-- Quên mật khẩu -->
          <div class="text-right p-t-8 p-b-31">
            <a href="#">Quên mật khẩu?</a>
          </div>
          <!-- End Quên mật khẩu -->
          <!-- Button đăng nhập -->
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn">Đăng nhập</button>
            </div>
          </div>
          <!-- End Button đăng nhập -->
          <div class="mt-2 text-center">
            <span class="p-b-17">
              Bạn chưa có tài khoản
              <router-link to="register">Đăng ký</router-link>
            </span>
          </div>
        </form>
      </div>
      <!-- Footer -->
      <div class="site-footer mt-4">
        <div class="site-footer-legal">
          © 2019
          <a href="#">Food Review</a>
          Crafted with
          <i class="red-600 wb wb-heart"></i> by
          <a href="#">ThanhLV</a>
        </div>
      </div>
      <!-- End Footer -->
    </div>
  </div>
</template>
<script>
// import TravelMap from "../../js/components/TravelMap";
export default {
  // components: {
  //   TravelMap
  // },
  data() {
    return {
      loginData: {
        email: "",
        password: "",
        remember: "",
      }
    };
  },
  methods: {}
};
</script>
<style lang="css">
.travel-map {
  height: 400px;
}
.google-map {
  min-height: 100%;
}
</style>
