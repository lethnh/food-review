<template>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54 shadow">
        <form class="login100-form validate-form">
          <span class="login100-form-title p-b-49">Đăng nhập</span>

          <div class="wrap-input100 validate-input m-b-23">
            <span class="label-input100">Email</span>
            <input class="input100" type="email" name="email"/>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">Mật khẩu</span>
            <input class="input100" type="password" name="pass" />
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="text-right p-t-8 p-b-31">
            <a href="#">Quên mật khẩu?</a>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn">Đăng nhập</button>
            </div>
          </div>
          <div class="mt-2 text-center">
            <span class="p-b-17">
              Bạn chưa có tài khoản
              <router-link to="register">Đăng ký</router-link>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>
