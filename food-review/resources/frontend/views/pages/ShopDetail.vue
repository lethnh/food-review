<template>
  <div class="row">
    <div class="col-5">
      <img src="https://picsum.photos/2000/350" class="img-fluid" alt />
    </div>
    <div class="col-7">
      <div class="shop-rate">
        <!-- <Rate v-model="shop.stars" disable allowHalf /> -->
        <!-- <span>{{ shop.stars }}</span> -->
      </div>
    </div>
  </div>
</template>
<script>
import ShopService from "../../js/services/Shop";
export default {
  data() {
    return {
      shop: {}
    };
  },
  mounted() {},
  methods: {
    
  }
};
</script>