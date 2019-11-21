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
          <div class="bg-white p-2">
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
              v-show="post_reviews !== null"
              class="text-center mt-3"
              @change="onChange"
              :pageSize="post_reviews.per_page"
              :total="post_reviews.total"
            />
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
      post_review_view: {}
    };
  },
  mounted() {
    this.getPostReviewLatestNew();
    this.getPostReviewHasManyComment();
    this.getPostReviewHasManyView();
  },
  methods: {
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
        console.log(response);
        if (response.status === 200) {
          this.isLoading = false;
          this.post_review_comment = response.data;
        }
      });
    },
    async getPostReviewHasManyView() {
      this.isLoading = true;
      PostReviewService.getPostReviewHasManyView().then(response => {
        console.log(response);
        if (response.status === 200) {
          this.isLoading = false;
          this.post_review_view = response.data;
        }
      });
    }
  }
};
</script>