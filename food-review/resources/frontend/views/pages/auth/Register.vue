<template>
  <div class="limiter">
    <div class="container-login100 flex-column">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54 shadow">
        <ValidationObserver v-slot="{ passes }" ref="registerForm" tag="form">
          <form class="login100-form validate-form" @submit.prevent="registerSubmit()">
            <span class="login100-form-title p-b-49">
              <router-link to="/">
                <img src="/images/icon/logo2.png" alt="IMG-LOGO" />
              </router-link>
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
                      class="form-control"
                      v-model="registerData.email"
                      :class="{'is-invalid': errors[0]}"
                    />
                  </div>
                  <small :class="{'is-danger': errors[0]}">{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
            </div>
            <!-- End Email -->
            <!-- Name -->
            <div class="m-b-23">
              <label class="label-input100">Tên</label>
              <ValidationProvider name="name" rules="required">
                <div slot-scope="{ errors }">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-user" aria-hidden="true"></i>
                      </div>
                    </div>
                    <input
                      type="text"
                      class="form-control"
                      v-model="registerData.name"
                      :class="{'is-invalid': errors[0]}"
                    />
                  </div>
                  <small :class="{'is-danger': errors[0]}">{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
            </div>
            <!-- End Name -->
            <!-- Password -->
            <div class="m-b-23">
              <label class="label-input100">Mật khẩu</label>
              <ValidationProvider name="password" rules="required|min:3" vid="confirmation">
                <div slot-scope="{ errors }">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                      </div>
                    </div>
                    <input
                      type="password"
                      class="form-control"
                      v-model="registerData.password"
                      :class="{'is-invalid': errors[0]}"
                    />
                  </div>
                  <small :class="{'is-danger': errors[0]}">{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
            </div>
            <!-- End Mật Khẩu -->
            <!-- Nhập lại mật khẩu -->
            <div class="m-b-23">
              <label class="label-input100">Nhập lại mật khẩu</label>
              <ValidationProvider
                name="password_confirmation"
                rules="required|confirmed:confirmation"
              >
                <div slot-scope="{ errors }">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                      </div>
                    </div>
                    <input
                      type="password"
                      data-vv-as="password"
                      class="form-control"
                      v-model="registerData.password_confirmation"
                      :class="{'is-invalid': errors[0]}"
                    />
                  </div>
                  <small :class="{'is-danger': errors[0]}">{{ errors[0] }}</small>
                </div>
              </ValidationProvider>
            </div>
            <!-- End Nhập lại mật khẩu -->

            <div class="container-login100-form-btn mt-5">
              <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn">Tạo tài khoản</button>
              </div>
            </div>
            <div class="mt-2 text-center">
              <span class="p-b-17">
                Bạn có tài khoản
                <router-link to="login">Đăng nhập</router-link>
              </span>
            </div>
          </form>
        </ValidationObserver>
      </div>
      <footer class="page-copyright mt-3">
        <p>WEBSITE BY ThanhLV</p>
        <p>© 2019. All RIGHT RESERVED.</p>
        <div class="social mt-1">
          <a class="btn-icon" href>
            <i class="fab fa-facebook-f"></i>
          </a>
          <a class="btn-icon" href>
            <i class="fab fa-facebook" aria-hidden="true"></i>
          </a>
          <a class="btn-icon" href>
            <i class="fab fa-dribbble" aria-hidden="true"></i>
          </a>
        </div>
      </footer>
    </div>
  </div>
</template>
<script>
import AuthService from "../../../js/services/Auth";
export default {
  data() {
    return {
      registerData: {
        email: "",
        password: "",
        name: "",
        password_confirmation: ""
      }
    };
  },
  methods: {
    async registerSubmit() {
      const isValid = await this.$refs.registerForm.validate();
      if (isValid) {
        AuthService.register(this.registerData).then(response => {
          debugger
          if (response.status === 200) {
            this.$route.push("login");
          }
        });
      }
    }
  }
};
</script>
