<template>
  <div class="template-container">
	<!-- Header -->
    <site-header></site-header>
    <div class="content bg-content">
      <!-- Slide1 -->
      <silde-bar></silde-bar>
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
      <!-- Slide1 -->
      <div class="container m-b-50 m-t-50">
        <router-view></router-view>
      </div>
    </div>
	<!-- Footer -->
    <site-footer></site-footer>
  </div>
</template>
<script type="text/babel">
import SiteHeader from "./partials/Header.vue";
import SiteFooter from "./partials/Footer";
import SildeBar from './partials/SlideBar.vue'

export default {
  components: {
    SiteHeader,
    SiteFooter,
    SildeBar,
  }
};
</script>

