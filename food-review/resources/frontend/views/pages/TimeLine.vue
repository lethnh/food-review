<template>
  <div>
    <div class="row">
      <div class="col-8">
        <div class="bg-white p-2">
          <h4 class="pb-2" style="border-bottom: 5px solid lightgray;">Dòng thời gian</h4>
          <div
            class="post-item border-bottom"
            v-for="(post, index) in post_reviews.data"
            :key="index"
          >
            <router-link
              v-if="post.feature_image !== null"
              :to="{ name: 'postReviewDetail', params: { post_id: post.id }}"
            >
              <img :src="post.feature_image" class="mr-3 img-fluid" alt="..." />
            </router-link>
            <router-link v-else :to="{ name: 'postReviewDetail', params: { post_id: post.id }}">
              <img src="/images/noimage.png" class="mr-3 img-fluid" alt="..." />
            </router-link>
            <div class="post-body">
              <router-link :to="{ name: 'postReviewDetail', params: { post_id: post.id }}">
                <h5>{{ post.title }}</h5>
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
          <a-pagination
            v-show="post_reviews !== null"
            class="text-center mt-3"
            @change="onChange"
            :pageSize="post_reviews.per_page"
            :total="post_reviews.total"
          />
        </div>
      </div>
      <div class="col-4 bg-white">
        <div>
          <h4 class="py-2" style="border-bottom: 5px solid lightgray;">Lượt xem nhiều nhất</h4>
          <div class="list-post-review-top-view row">
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
                  <Rate v-model="post.stars" disable />
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
                  </div> -->
                </div>
                <div></div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <h4 class="py-2" style="border-bottom: 5px solid lightgray;">Bình luận nhiều nhất</h4>
          <div class="list-post-review-top-view row">
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
                  <Rate v-model="post.stars" disable />
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
    async getPostReviewLatestNew(page) {
      PostReviewService.getPostReviewLatestNew(page).then(response => {
        // if (response.status === 200) {
        this.post_reviews = response;
        // }
      });
    },
    onChange(current) {
      this.getPostReviewLatestNew(current);
    },
    async getPostReviewHasManyComment() {
      PostReviewService.getPostReviewHasManyComment().then(response => {
        console.log(response);
        if (response.status === 200) {
          this.post_review_comment = response.data;
        }
      });
    },
    async getPostReviewHasManyView() {
      PostReviewService.getPostReviewHasManyView().then(response => {
        console.log(response);
        if (response.status === 200) {
          this.post_review_view = response.data;
        }
      });
    }
  }
};
</script>