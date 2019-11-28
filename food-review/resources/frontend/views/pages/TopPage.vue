<template>
  <div>
    <loading
      :active.sync="isLoading"
      :color="color"
      :width="width"
      :height="height"
      :isFullPage="isFullPage"
      :backgroundColor="backgroundColor"
      :opactiy="opacity"
    ></loading>
    <div class="d-flex p-2 align-items-center panel">
      <div class="mr-2">Lọc:</div>
      <a-select
        style="width: 200px"
        class="mr-2"
        :defaultValue="defaulValue"
        @change="handleProvinceChange"
      >
        <a-select-option v-for="province in citiesData" :key="province.id">{{province.name}}</a-select-option>
      </a-select>
      <a-select style="width: 200px" :defaultValue="defaulValue2">
        <a-select-option v-for="district in districts" :key="district.id">{{district.name}}</a-select-option>
      </a-select>
    </div>
    <section>
      <div class="section-title bg-white">
        <h5 class="p-2" style>Cửa hàng review nhiều nhất</h5>
      </div>
      <div class="section-content m-t-20">
        <div class="list-shops panel">
          <div class="row">
            <div class="col-3" v-for="(shop, index) in shop_post_review" :key="index">
              <b-card
                v-if="shop.feature_image !== null"
                tag="article"
                class="shadow h-100"
              >
                <router-link :to="{ name: 'shopDetail', params: { shop_id: shop.id }}">
                  <img :src="shop.feature_image" alt="" class="img-fluid mb-2">
                  <h6 class="card-title">{{ shop.name }}</h6>
                </router-link>
                <div class="d-flex align-items-center">
                  <div class="shop-rate">
                    <Rate disabled v-model="shop.stars" allowHalf />
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
              <b-card
                v-else
                tag="article"
                class="shadow h-100"
              >
                <router-link :to="{ name: 'shopDetail', params: { shop_id: shop.id }}">
                  <img src="https://picsum.photos/600/600/?image=25" alt="" class="img-fluid mb-2">
                  <h6 class="card-title">{{ shop.name }}</h6>
                </router-link>
                <div class="d-flex align-items-center">
                  <div class="shop-rate mb-2">
                    <Rate disabled v-model="shop.stars" allowHalf />
                    <span>{{ shop.stars }}</span>
                  </div>
                  <div class="ml-3 shop-comment ml-auto">
                    <i class="fas fa-newspaper"></i>
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
    <!-- <section>
      <div class="section-title bg-white">
        <h5 class="p-2">Cửa hàng review gần đây</h5>
      </div>
      <div class="section-content m-t-20">
        <div class="list-shops panel">
          <div class="row">
          <div class="col-3" v-for="(shop, index) in shop_new" :key="index">
                <b-card
                v-if="shop.shop.feature_image !== null"
                tag="article"
                class="shadow h-100"
              >
                <router-link :to="{ name: 'shopDetail', params: { shop_id: shop.shop.id }}">
                  <img :src="shop.shop.feature_image" alt="" class="img-fluid mb-2">
                  <h6 class="card-title">{{ shop.shop.name }}</h6>
                </router-link>
                <div class="d-flex align-items-center">
                  <div class="shop-rate">
                    <Rate disabled v-model="shop.shop.stars" allowHalf />
                    <span>{{ shop.shop.stars }}</span>
                  </div>
                  <div class="ml-3 shop-comment ml-auto">
                    <i class="fas fa-edit"></i>
                    <span>{{ shop.shop.post_reviews_count }}</span>
                  </div>
                </div>
                <div class="shop-money">
                  <i class="fas fa-money-bill"></i>
                  <span>{{ shop.shop.money | currency}}</span>
                </div>
                <div class="shop-address">
                  <small class="text-muted">
                    <i class="fas fa-map-marker-alt"></i>
                    {{shop.shop.district.name}}, {{ shop.shop.city.name }}
                  </small>
                </div>
                <b-card-text></b-card-text>
                <template v-slot:footer>
                  <a href class="shop-tag rounded">cửa hàng</a>
                </template>
              </b-card>
              <b-card
                v-else
                img-alt="Image"
                img-top
                tag="article"
                class="shadow h-100"
              >
                <router-link :to="{ name: 'shopDetail', params: { shop_id: shop.shop.id }}">
                  <img src="https://picsum.photos/600/600/?image=25" alt="" class="img-fluid mb-2">
                  <h6 class="card-title">{{ shop.shop.name }}</h6>
                </router-link>
                <div class="d-flex align-items-center">
                  <div class="shop-rate">
                    <Rate disabled v-model="shop.shop.stars" allowHalf />
                    <span>{{ shop.shop.stars }}</span>
                  </div>
                  <div class="ml-3 shop-comment ml-auto">
                    <i class="fas fa-edit"></i>
                    <span>{{ shop.shop.post_reviews_count }}</span>
                  </div>
                </div>
                <div class="shop-money">
                  <i class="fas fa-money-bill"></i>
                  <span>{{ shop.shop.money | currency}}</span>
                </div>
                <div class="shop-address">
                  <small class="text-muted">
                    <i class="fas fa-map-marker-alt"></i>
                    {{shop.shop.district.name}}, {{ shop.shop.city.name }}
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
    </section> -->
  </div>
</template>
<script>
import ShopService from "../../js/services/Shop";
import CityService from "../../js/services/City";
export default {
  data() {
    return {
      color: "#267BFF",
      isFullPage: true,
      width: 75,
      height: 85,
      opacity: 0.5,
      zIndex: 999,
      backgroundColor: "#808080",
      loader: "spinner",

      isLoading: false,
      citiesData: {},
      districtsData: {},
      cities: {},
      districts: {},
      defaulValue: "An Giang",
      defaulValue2: "",
      shops: {},
      shop_post_review: {},
      shop_new: {
        shop:{}
      }
    };
  },
  mounted() {
    // this.getListShop();
    this.getShopHasManyPostReview();
    this.getShopNew();
    this.getCities();
  },
  methods: {
    getCities() {
      CityService.getCities().then(response => {
        let cities = [];
        let districts = [];
        response.forEach(element => {
          if (element["districts"]) {
            districts.push(element["districts"]);
          }
          cities.push(element);
        });
        this.citiesData = cities;
        this.districtsData = districts;
      });
    },
    async getListShop() {
      this.isLoading = true;
      ShopService.getShops().then(response => {
        this.isLoading = false;
        this.shops = response;
      });
    },
    async getShopHasManyPostReview() {
      this.isLoading = true;
      ShopService.getShopHasManyPostReview().then(response => {
        this.isLoading = false;
        if (response.status === 200) {
          this.shop_post_review = response.data;
        }
      });
    },
       async getShopNew() {
      this.isLoading = true;
      ShopService.getShopNew().then(response => {
        this.isLoading = false;
        if (response.status === 200) {
          this.shop_new = response.data;
        }
      });
    },
    handleProvinceChange(value) {
      this.districts = this.districtsData[value - 1];
      this.defaulValue2 = this.districtsData[value - 1][0];
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
.section-title {
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}
</style>