<template>
  <div class="row">
      <div class="d-flex col-12 p-2 align-items-center panel">
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
    <div class="col-6">
      <div class="panel panel-bordered">
        <div class="panel-heading">
          <p
            class="panel-title"
          >{{post_reviews.data.length}} kết quả "{{this.$route.query.searchText}}" trong bài vết</p>
        </div>
        <div class="panel-body">
          <div
            class="post-item border-bottom"
            v-for="(post, index) in post_reviews.data"
            :key="index"
          >
            <router-link
              v-if="post.feature_image !== null"
              :to="{ name: 'postReviewDetail', params: { post_id: post.id }}"
            >
              <img :src="post.feature_image" class="img-fluid" alt="..." />
            </router-link>
            <router-link v-else :to="{ name: 'postReviewDetail', params: { post_id: post.id }}">
              <img src="/images/noimage.png" class="img-fluid" alt="..." />
            </router-link>
            <div class="post-body col-9">
              <router-link :to="{ name: 'postReviewDetail', params: { post_id: post.id }}">
                <h5 class="text-justify">{{ post.title }}</h5>
              </router-link>
              <div>{{ post.money | currency}}</div>
              <div>
                <Rate v-model="post.stars" disable />
                <span>{{ post.stars }} sao</span>
              </div>
              <div class="action">
                <!-- <div>
                  <i class="fas fa-thumbs-up"></i>
                </div>
                <div>
                  <i class="fas fa-thumbs-down"></i>
                </div>-->
                <div class="mr-2">
                  <i class="far fa-eye"></i>
                  {{ post.total_view }}
                </div>
                <div>
                  <i class="fas fa-comment-dots"></i>
                  {{ post.totalComment }}
                </div>
              </div>
              <div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="panel panel-bordered">
        <div class="panel-heading">
          <p
            class="panel-title"
          >{{shops.data.length}} kết quả "{{this.$route.query.searchText}}" trong cửa hàng</p>
        </div>
        <div class="panel-body list-shops">
          <div class="row">
            <div class="col-6" v-for="(shop, index) in shops.data" :key="index">
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
    </div>
  </div>
</template>
<script>
import PostReviewServices from "../../js/services/PostReview";
export default {
  data() {
    return {
      post_reviews: {
        data: {}
      },
      countPostReview: 0,
      countShop: 0,
      shops: {
        data: {}
      },
      city_id: this.$route.query.city_id,
      searchText: this.$route.query.searchText
    };
  },
  watch: {
    "$route.query"() {
      this.city_id = this.$route.query.city_id;
      this.searchText = this.$route.query.searchText;
      this.searchPostReview();
    }
  },
  mounted() {
    this.searchPostReview();
  },
  methods: {
    async searchPostReview() {
      PostReviewServices.searchText({
        city_id: this.city_id,
        searchText: this.searchText
      }).then(response => {
        console.log(response);
        this.post_reviews = response.post_reviews;
        this.shops = response.shops;
        this.countPostReview = this.post_reviews.data.length;
        this.countShop = this.shops.data.length;
      });
    }
  }
};
</script>
<style lang="css" scoped>
.panel {
  position: relative;
  margin-bottom: 2.143rem;
  background-color: #fff;
  border: 0 solid transparent;
  border-radius: 0.286rem;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}

.panel-heading {
  border-top-left-radius: 0.214rem;
  border-top-right-radius: 0.214rem;
  position: relative;
  padding: 0;
  border-bottom: 1px solid transparent;
}

.panel-bordered > .panel-heading {
  border-bottom: 1px solid #e4eaec;
}

.panel-body {
  position: relative;
  padding: 30px 30px;
}

.panel-bordered > .panel-body {
  padding-top: 30px;
}
</style>