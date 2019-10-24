<template>
  <div>
    <div class="row">
      <div class="col-8">
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
              <img
                :src="post.feature_image"
                class="mr-3 img-fluid"
                style="width:160px;object-fit: cover;"
                alt="..."
              />
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
                </div> -->
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
        <div class="p-2">bài viết topview</div>
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
      }
    };
  },
  mounted() {
    this.getPostReviewLatestNew();
  },
  methods: {
    getPostReviewLatestNew(page) {
      PostReviewService.getPostReviewLatestNew(page).then(response => {
        this.post_reviews = response;
      });
    },
    onChange(current) {
      this.getPostReviewLatestNew(current);
    }
  }
};
</script>