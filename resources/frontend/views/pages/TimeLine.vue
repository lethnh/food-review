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
    <div class="row">
      <div class="col-8">
        <div class="px-2 pb-2">
          <div class="bg-white mb-2 section-title">
            <h5 class="p-2">Dòng thời gian</h5>
          </div>
            <div class="panel p-2">
            <div class="">
                <div class="mr-2">Tỉnh Thành Phố:</div>
                <a-select
                    style="width: 200px"
                    class="mr-2"
                    :defaultValue="defaulValue"
                    @change="handleProvinceChange"
                >
                    <a-select-option
                        v-for="province in citiesData"
                        :key="province.id"
                        >{{ province.name }}</a-select-option
                    >
                </a-select>
                <a-select style="width: 200px" :defaultValue="defaulValue2" @change="handleDistrictChange">
                    <a-select-option
                        v-for="district in districts"
                        :key="district.id"
                        >{{ district.name }}</a-select-option
                    >
                </a-select>
            </div>
            <div class="pt-2">
                <div class="mr-2">Số sao:</div>
                <Rate
                    v-model="searchData.stars"
                    :min="1"
                    @change="onChangeSlider"
                />
                <span>{{ searchData.stars }} sao</span>
            </div>
            <div class="pt-2 w-100">
                <div class="">Số tiền trung bình:</div>
                <a-slider
                    class="w-100"
                    :step="10000"
                    v-model="searchData.money"
                    :min="10000"
                    :max="1000000"
                    @afterChange="onChangeSlider"
                />
                <span class="btn btn-primary">{{ searchData.money }} VNĐ</span>
            </div>
        </div>
          <div class="bg-white p-2"  v-if="post_reviews.data != 0">
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
                  <div v-html="sliceContent(post.content)"></div>
                </router-link>
                <div>{{ post.money | currency}}</div>
                <div>
                  <Rate v-model="post.stars" disabled />
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
            <a-pagination
              v-show="post_reviews.last_page >=2"
              class="text-center mt-3"
              @change="onChange"
              :pageSize="post_reviews.per_page"
              :total="post_reviews.total"
            />
          </div>
          <div class="bg-white py-5" v-else>
            Không có bài viết nào phù hợp
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="bg-white row mb-2 section-title">
          <h5 class="px-2 pt-2">Lượt xem nhiều nhất</h5>
        </div>
        <div class>
          <div class="list-post-review-top-view row bg-white pt-2">
            <div
              class="post-item border-bottom col-6"
              v-for="(post, index) in post_review_view"
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
              <div class="post-body">
                <router-link :to="{ name: 'postReviewDetail', params: { post_id: post.id }}">
                  <h5 v-if="post.title.length > 50 ">{{ post.title.substring(0, 50) + '...' }}</h5>
                  <h5 v-else>{{ post.title }}</h5>
                </router-link>
                <div>{{ post.money | currency}}</div>
                <div>
                  <Rate v-model="post.stars" disabled />
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
                  <!-- <div>
                    <i class="fas fa-comment-dots"></i>
                    {{ post.totalComment }}
                  </div>-->
                </div>
                <div></div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div class="bg-white row my-2 section-title">
            <h4 class="px-2 pt-2">Bình luận nhiều nhất</h4>
          </div>
          <div class="list-post-review-top-view row bg-white">
            <div
              class="post-item border-bottom col-6"
              v-for="(post, index) in post_review_comment"
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
              <div class="post-body">
                <router-link :to="{ name: 'postReviewDetail', params: { post_id: post.id }}">
                  <h5>{{ post.title }}</h5>
                </router-link>
                <div>{{ post.money | currency}}</div>
                <div>
                  <Rate v-model="post.stars" disabled />
                </div>
                <div class="action">
                  <!-- <div>
                  <i class="fas fa-thumbs-up"></i>
                </div>
                <div>
                  <i class="fas fa-thumbs-down"></i>
                  </div>-->
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
    </div>
  </div>
</template>
<script>
import PostReviewService from "../../js/services/PostReview.js";
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
      post_reviews: {
        data: {}
      },
      post_review_comment: {},
      post_review_view: {},
          citiesData: {},
      districtsData: {},
      cities: {},
      districts: {},
      defaulValue: "An Giang",
      defaulValue2: "",
      searchData: {
        money: 0,
        stars: 1,
        city_id: '',
        district_id: '',
      }
    };
  },
  mounted() {
    this.getPostReviewLatestNew();
    this.getPostReviewHasManyComment();
    this.getPostReviewHasManyView();
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
    sliceContent(content) {
      let index = content.indexOf("</p>");
      return content.slice(0, index);
    },
    async getPostReviewLatestNew(page) {
      this.isLoading = true;
      PostReviewService.getPostReviewLatestNew(page).then(response => {
        // if (response.status === 200) {
        this.isLoading = false;
        this.post_reviews = response;
        // }
      });
    },
    onChange(current) {
      this.getPostReviewLatestNew(current);
    },
    async getPostReviewHasManyComment() {
      this.isLoading = true;
      PostReviewService.getPostReviewHasManyComment().then(response => {
        
        if (response.status === 200) {
          this.isLoading = false;
          this.post_review_comment = response.data;
        }
      });
    },
    async getPostReviewHasManyView() {
      this.isLoading = true;
      PostReviewService.getPostReviewHasManyView().then(response => {
        
        if (response.status === 200) {
          this.isLoading = false;
          this.post_review_view = response.data;
        }
      });
    },
     handleProvinceChange(value) {
      this.districts = this.districtsData[value - 1];
      // this.defaulValue2 = this.districtsData[value - 1][0];
      this.searchData.city_id = value;
      this.searchPostReview(this.searchData);
    },

    handleDistrictChange(value){
      debugger
      this.searchData.district_id = value;
      this.searchPostReview(this.searchData);
    },
     searchPostReview(data) {
      PostReviewService.searchPostReviews(data).then(response => {
        // if (response.status === 200) {
          this.post_reviews = response;
        // }
      });
    },
    onChangeSlider(){
      this.searchPostReview(this.searchData);
    }
  }
};
</script>