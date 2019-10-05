<template>
  <header>
    <!-- Header desktop -->
    <div class="wrap-menu-header gradient1 trans-0-4">
      <div class="container h-full">
        <div class="wrap_header trans-0-3">
          <!-- Logo -->
          <div class="logo">
            <router-link to="/">
              <img
                src="/images/icon/logo.png"
                alt="IMG-LOGO"
                data-logofixed="/images/icon/logo2.png"
              />
            </router-link>
          </div>

          <!-- Menu -->
          <div class="wrap_menu p-l-45 p-l-0-xl">
            <nav class="menu">
              <ul class="main_menu">
                <li>
                  <a href="index.html">Trang chủ</a>
                </li>

                <li>
                  <a href="menu.html">Menu</a>
                </li>

                <li>
                  <a href="reservation.html">Reservation</a>
                </li>

                <li>
                  <a href="gallery.html">Gallery</a>
                </li>

                <li>
                  <a href="about.html">About</a>
                </li>

                <li>
                  <a href="blog.html">Blog</a>
                </li>

                <li>
                  <a href="contact.html">Liên hệ</a>
                </li>
              </ul>
            </nav>
          </div>

          <!-- Social -->
          <div class="social flex-w flex-l-m p-r-20">
            <a href="#">
              <!-- <i class="fab fa-tripadvisor m-l-21"></i> -->
            </a>
            <a href="#">
              <!-- <i class="fab fa-facebook m-l-21" aria-hidden="true"></i> -->
            </a>
            <a href="#">
              <!-- <i class="fab fa-twitter m-l-21" aria-hidden="true"></i> -->
            </a>
            <router-link to="register" class="btn btn-outline-light">Đăng ký</router-link>
            <router-link to="login" class="m-l-21 btn btn-outline-light">Đăng nhập</router-link>
            <button class="btn-show-sidebar m-l-33 trans-0-4 d-sm-none"></button>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
<script>
export default {};
</script>
<style lang="css">
  .wrap-menu-header{
    background-color: rgb(16, 11, 17);
  }
</style>