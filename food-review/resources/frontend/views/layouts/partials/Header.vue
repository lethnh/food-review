<template>
  <div>
    <!-- Header -->
    <header>
      <!-- Header desktop -->
      <div class="wrap-menu-header gradient1 trans-0-4">
        <div class="container h-full">
          <div class="wrap_header trans-0-3">
            <!-- Logo -->
            <div class="logo">
              <a href="index.html">
                <img
                  src="images/icons/logo.png"
                  alt="IMG-LOGO"
                  data-logofixed="images/icons/logo2.png"
                />
              </a>
            </div>

            <!-- Menu -->
            <div class="wrap_menu p-l-45 p-l-0-xl">
              <nav class="menu">
                <ul class="main_menu">
                  <li>
                    <a href="index.html">Home</a>
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
                    <a href="contact.html">Contact</a>
                  </li>
                </ul>
              </nav>
            </div>

            <!-- Social -->
            <div class="social flex-w flex-l-m p-r-20">
              <a href="#">
                <i class="fa fa-tripadvisor" aria-hidden="true"></i>
              </a>
              <a href="#">
                <i class="fa fa-facebook m-l-21" aria-hidden="true"></i>
              </a>
              <a href="#">
                <i class="fa fa-twitter m-l-21" aria-hidden="true"></i>
              </a>

              <button class="btn-show-sidebar m-l-33 trans-0-4"></button>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Slide1 -->
    <section class="section-slide">
      <div class="wrap-slick1">
        <div class="slick1">
          <div
            class="item-slick1 item1-slick1"
            style="background-image: url(/images/slide1-01.jpg);"
          >
            <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
              <span
                class="caption1-slide1 txt1 t-center animated visible-false m-b-15"
                data-appear="fadeInDown"
              >Welcome to</span>

              <h2
                class="caption2-slide1 tit1 t-center animated visible-false m-b-37"
                data-appear="fadeInUp"
              >Pato Place</h2>

              <div class="wrap-btn-slide1 animated visible-false" data-appear="zoomIn">
                <!-- Button1 -->
                <a href="menu.html" class="btn1 flex-c-m size1 txt3 trans-0-4">Look Menu</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
export default {};
</script>