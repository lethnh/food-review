<template>
  <div>
    <div class="d-flex mb-5 align-items-center">
      <div class="mr-2">Địa điểm:</div>
      <a-select
        :defaultValue="provinceData[0]"
        style="width: 120px"
        class="mr-2"
        @change="handleProvinceChange"
      >
        <a-select-option v-for="province in provinceData" :key="province">{{province}}</a-select-option>
      </a-select>
      <a-select v-model="secondCity" style="width: 120px">
        <a-select-option v-for="city in cities" :key="city">{{city}}</a-select-option>
      </a-select>
    </div>
    <section>
      <div class="section-title">
        <h4 class="pb-2" style="border-bottom: 5px solid lightgray;">Cửa hàng review nhiều nhất</h4>
      </div>
      <div class="section-content m-t-20">
        <div class="list-shops">
          <div class="row">
            <div class="col-3" v-for="(shop, index) in shop_post_review" :key="index">
              <b-card
                img-src="https://picsum.photos/600/600/?image=25"
                img-alt="Image"
                img-top
                tag="article"
                class="mb-2 shadow"
              >
                <router-link :to="{ name: 'shopDetail', params: { shop_id: shop.id }}">
                  <h4 class="card-title">{{ shop.name }}</h4>
                </router-link>
                <div class="d-flex align-items-center">
                  <div class="shop-rate">
                    <Rate v-model="shop.stars" disable allowHalf />
                    <span>{{ shop.stars }}</span>
                  </div>
                  <div class="ml-3 shop-comment ml-auto">
                    <i class="fas fa-edit"></i>
                    <span>{{ shop.post_reviews_count }}</span>
                  </div>
                </div>
                <div class="shop-money">
                  <i class="fas fa-money-bill"></i>
                  <span>{{ shop.money | currency}}</span>
                </div>
                <div class="shop-address">
                  <small class="text-muted">
                    <i class="fas fa-map-marker-alt"></i>
                    {{shop.district.name}}, {{ shop.city.name }}
                  </small>
                </div>
                <b-card-text></b-card-text>
                <template v-slot:footer>
                  <a href class="shop-tag rounded">cửa hàng</a>
                </template>
              </b-card>
            </div>
          </div>
        </div>
      </div>
    </section>
    <hr class="my-5" />
    <section>
      <div class="section-title">
        <h4 class="pb-2" style="border-bottom: 5px solid lightgray;">Cửa hàng review gần đây</h4>
      </div>
      <div class="section-content m-t-20">
        <div class="list-shops">
          <div class="row">
            <div class="col-3">
              <b-card
                img-src="https://picsum.photos/600/600/?image=25"
                img-alt="Image"
                img-top
                tag="article"
                class="mb-2 shadow"
              >
                <a href>
                  <h4 class="card-title">Card Title</h4>
                </a>
                <div class="d-flex align-items-center">
                  <div class="shop-rate">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <span>5</span>
                  </div>
                  <div class="ml-3 shop-comment ml-auto">
                    <i class="fas fa-comment-dots"></i>
                    <span>0</span>
                  </div>
                </div>
                <div class="shop-money">
                  <i class="fas fa-money-bill"></i> 100.000 đ
                </div>
                <div class="shop-address">
                  <small class="text-muted">
                    <i class="fas fa-map-marker-alt"></i>
                    Hà Nội
                  </small>
                </div>
                <b-card-text></b-card-text>
                <template v-slot:footer>
                  <a href class="shop-tag rounded">cửa hàng</a>
                </template>
              </b-card>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import ShopService from "../../js/services/Shop";
const provinceData = ["Zhejiang", "Jiangsu"];
const cityData = {
  Zhejiang: ["Hangzhou", "Ningbo", "Wenzhou"],
  Jiangsu: ["Nanjing", "Suzhou", "Zhenjiang"]
};
export default {
  data() {
    return {
      provinceData,
      cityData,
      cities: cityData[provinceData[0]],
      secondCity: cityData[provinceData[0]][0],
      shops: {},
      shop_post_review: {}
    };
  },
  mounted() {
    // this.getListShop();
    this.getShopHasManyPostReview();
  },
  methods: {
    async getListShop() {
      ShopService.getShops().then(response => {
        this.shops = response;
      });
    },
    async getShopHasManyPostReview() {
      ShopService.getShopHasManyPostReview().then(response => {
        if (response.status === 200) {
          this.shop_post_review = response.data;
        }
      });
    },
    handleProvinceChange(value) {
      this.cities = cityData[value];
      this.secondCity = cityData[value][0];
    }
  }
};
</script>
<style lang="css" scoped>
.card-body,
.card-footer {
  padding: 0.75rem;
}
.card-footer {
  background-color: #fff;
}
</style>