<template>
  <div class="template-container">
    <!-- Header -->
    <site-header></site-header>
    <slide-bar></slide-bar>
    <section class="section-slide">
      <div class="wrap-slick1">
        <div class="slick1">
          <div
            class="item-slick1 item1-slick1"
            style="background-image: url(/images/home-slide-3-1920x800.jpg);"
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
    <div class="content page">
      <div class="container m-b-50">
        <router-view></router-view>
      </div>
    </div>
    <!-- Footer -->
    <site-footer></site-footer>
  </div>
</template>
<script>
import SlideBar from "../layouts/partials/SildeBar";

export default {
  components: {
      SlideBar
  }
};
</script>