<template>
  <div class="limiter">
    <div class="container-login100 flex-column">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54 shadow">
        <form class="login100-form validate-form">
          <span class="login100-form-title p-b-49">
            <router-link to="/">
              <img src="/images/icon/logo2.png" alt="IMG-LOGO" />
            </router-link>
          </span>
          <!-- 
          <div class="wrap-input100 validate-input m-b-23">
            <span class="label-input100">Email</span>
            <input class="input100" type="email" name="email" />
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>-->

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
                  <input type="email" class="form-control border" />
                </div>
                <small class="color0">{{ errors[0] }}</small>
              </div>
            </ValidationProvider>
          </div>
          <!-- 
          <div class="wrap-input100 validate-input m-b-23">
            <span class="label-input100">Tên</span>
            <input class="input100" type="text" name="username" />
            <span class="symbol-input100">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </div>-->

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
                  <input type="email" class="form-control border" />
                </div>
                <small class="color0">{{ errors[0] }}</small>
              </div>
            </ValidationProvider>
          </div>

          <!-- <div class="wrap-input100 validate-input m-b-23">
            <span class="label-input100">Mật khẩu</span>
            <input class="input100" type="password" name="pass" />
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>-->

          <div class="m-b-23">
            <label class="label-input100">Mật khẩu</label>
            <ValidationProvider name="password" rules="required">
              <div slot-scope="{ errors }">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                  </div>
                  <input type="email" class="form-control border" />
                </div>
                <small class="color0">{{ errors[0] }}</small>
              </div>
            </ValidationProvider>
          </div>

          <!-- <div class="wrap-input100 validate-input">
            <span class="label-input100">Nhập lại mật khẩu</span>
            <input class="input100" type="password" name="pass" />
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div> -->

          <div class="m-b-23">
            <label class="label-input100">Nhập lại mật khẩu</label>
            <ValidationProvider name="password_match" rules="required">
              <div slot-scope="{ errors }">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fa fa-lock" aria-hidden="true"></i>
                    </div>
                  </div>
                  <input type="email" class="form-control border" />
                </div>
                <small class="color0">{{ errors[0] }}</small>
              </div>
            </ValidationProvider>
          </div>

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
      </div>
      <div class="site-footer mt-4">
        <div class="site-footer-legal">
          © 2019
          <a href="#">Food Review</a>
          Crafted with
          <i class="red-600 wb wb-heart"></i> by
          <a href="#">ThanhLV</a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {};
  }
};
</script>
