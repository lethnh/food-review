<template>
  <div class="limiter">
    <div class="container-login100 flex-column">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54 shadow">
        <ValidationObserver v-slot="{ passes }" ref="forgotForm" tag="form">
          <form class="login100-form validate-form" @submit.prevent="forgotSubmit()">
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
                    <input
                      type="email"
                      v-model="email"
                      class="form-control"
                      :class="{'is-invalid': errors[0]}"
                    />
                  </div>
                  <small :class="{'is-danger': errors[0]}">{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
            </div>
            <!-- End Email -->
            <!-- Button đăng nhập -->
            <div class="container-login100-form-btn">
              <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn">Gửi yêu cầu</button>
              </div>
            </div>
            <!-- End Button đăng nhập -->
          </form>
        </ValidationObserver>
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
import AuthService from "../../../js/services/Auth";
export default {
  data() {
    return {
      email: ""
    };
  },
  methods: {
    async forgotSubmit() {
      const isValid = await this.$refs.forgotForm.validate();
      if (isValid) {
        AuthService.forgotPassword(this.email).then();
      }
    }
  }
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
