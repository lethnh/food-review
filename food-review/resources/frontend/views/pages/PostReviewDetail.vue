<template>
  <div>
    <div class="row">
      <div class="col-9 bg-white" style="padding-bottom:50px">
        <a-carousel arrows dotsClass="slick-dots slick-thumb">
          <a slot="customPaging" slot-scope="props">
            <img :src="getImgUrl(props.i)" />
          </a>
          <div v-for="(item, index) in post_review.post_review_images" :key="index">
            <img :src="item.link" />
          </div>
        </a-carousel>
      </div>
      <div class="col-3 bg-white border-left">
        <div class="content pt-2">
          <div class="user_info">
            <div class="rounded">
              <img src="/images/5.jpg" alt="..." class="rounded" />
            </div>
            <div>
              <p>{{ post_review.user.name }}</p>
              <p>
                <i class="fas fa-map-marker-alt"></i>
                {{post_review.user.district.name}}, {{post_review.user.city.name}}
              </p>
              <p>Số bài review: 1</p>
            </div>
          </div>
          <hr>
          <div class="shop_info mt-2">
            <span>Địa chỉ:</span>
            <i class="fas fa-map-marker-alt"></i>
            <span>{{ post_review.shop.address }}</span>
          </div>
          <div>
            <Rate v-model="post_review.stars" disabled></Rate>
            {{post_review.stars}} sao
          </div>
          <div>Tiền/người: {{post_review.money | currency}}</div>
          <div>Giờ mở cửa {{ post_review.shop.begin_time}} - đóng cửa: {{post_review.shop.close_time}}</div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-9 mt-5">
        <div class="bg-white p-2" style="min-height:450px">
          <h4 class="post_review_title">{{ post_review.title }}</h4>
          <div class="post_review_content" v-html="post_review.content"></div>
        </div>
      </div>
      <div class="col-3 mt-5">
        <div class="bg-white p-2">
          <h4 class="post_review_title">Bài viết liên quan</h4>
          <div>
            <div class="card">
              <img src="https://picsum.photos/600/600/?image=25" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p
                  class="card-text"
                >Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-9">
        <div class="post_review_comment bg-white p-2">
          <h4>Bình luận bài viết</h4>
          <div class="item_comment" v-for="(comment, index) in comments" :key="index">
            <div class="comment">
              <div class="comment_avatar">
                <img src="/images/5.jpg" alt class="rounded" />
              </div>
              <div class="comment_content">
                <div class="user_name ml-0">{{comment.user.name}}</div>
                <div class="content">{{comment.content}}</div>
                <div class="action">
                  {{comment.total_likes}}
                  <a
                    v-bind:class="styleLike(comment.likes,userStore.authUser.user_info.id)"
                    @click.prevent="likeComment(comment.id,1)"
                  >Thích</a>
                  <!-- :class="{'text-blue': auth_id =  }" -->
                  {{comment.total_dislikes}}
                  <a
                    v-bind:class="styleDisLike(comment.likes,userStore.authUser.user_info.id)"
                    @click.prevent="likeComment(comment.id,-1)"
                  >Không thích</a>
                </div>
              </div>
            </div>
            <div v-if="comment.sub_comment">
              <div class="comment_reply" v-for="(item, index) in comment.sub_comment" :key="index">
                <div class="comment_avatar">
                  <img src="/images/5.jpg" alt class="rounded" />
                </div>
                <div class="comment_content">
                  <div class="user_name ml-0">{{item.user.name}}</div>
                  <div class="content">{{item.content}}</div>
                  <div class="action">
                    {{item.total_likes}}
                    <a
                      v-bind:class="styleLike(item.likes,userStore.authUser.user_info.id)"
                      @click.prevent="likeComment(item.id,1)"
                    >Thích</a>
                    {{item.total_dislikes}}
                    <a
                      v-bind:class="styleDisLike(item.likes,userStore.authUser.user_info.id)"
                      @click.prevent="likeComment(item.id,-1)"
                    >Không thích</a>
                  </div>
                </div>
              </div>
              <div class="d-flex" style="margin:12px 12px 0px 0px;padding:0px 0px 0px 70px">
                <div class="rounded mr-2">
                  <img src="/images/5.jpg" alt class="rounded" style="height:32px" />
                </div>
                <form
                  class="form-group w-100"
                  @submit.prevent="commetPostReview(comment.id,$event)"
                >
                  <input type="text" class="form-control" placeholder="Viết bình luận" />
                  <!-- <small
                id="emailHelp"
                class="form-text text-muted"
                  >We'll never share your email with anyone else.</small>-->
                </form>
              </div>
            </div>
          </div>
          <!-- <div class="item_comment">
            <div class="comment">
              <div class="comment_avatar">
                <img src="/images/5.jpg" alt class="rounded" />
              </div>
              <div class="comment_content">
                <div class="user_name">ThanhLV</div>
                <div
                  class="content"
                >Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, porro? Nostrum quaerat nesciunt delectus in, officia expedita, nihil, earum rem illo dolor amet nobis? Itaque rerum ullam natus eum hic!</div>
                <div class="action">
                  <a href>Thích</a>
                  <a href>Không thích</a>
                  <a href>Trả lời</a>
                </div>
              </div>
            </div>
            <div class="comment_reply">
              <div class="comment_avatar">
                <img src="/images/5.jpg" alt class="rounded" />
              </div>
              <div class="comment_content">
                <div class="user_name">ThanhLV</div>
                <div
                  class="content"
                >Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, porro? Nostrum quaerat nesciunt delectus in, officia expedita, nihil, earum rem illo dolor amet nobis? Itaque rerum ullam natus eum hic!</div>
                <div class="action">
                  <a href>Thích</a>
                  <a href>Không thích</a>
                  <a href>Trả lời</a>
                </div>
              </div>
            </div>
          </div>-->
          <div class="d-flex" style="margin:12px">
            <div class="rounded mr-2">
              <img src="/images/5.jpg" alt class="rounded" style="height:48px" />
            </div>
            <form class="form-group w-100" @submit.prevent="commetPostReview(0,null)">
              <input
                type="text"
                class="form-control"
                v-model="commentData.content"
                placeholder="Viết bình luận"
              />
              <!-- <small
                id="emailHelp"
                class="form-text text-muted"
              >We'll never share your email with anyone else.</small>-->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState } from "vuex";
import PostReviewServices from "../../js/services/PostReview";
import CommentServices from "../../js/services/Comment";
export default {
  data() {
    return {
      post_review: {
        user: {
          city: {},
          district: {}
        },
        shop: {
          address: "",
          begin_time: "",
          close_time: ""
        }
      },
      actionComment: {
        status: null,
        comment_id: null
      },
      comments: {},
      commentData: {
        content: "",
        post_review_id: this.$route.params.post_id,
        parent_id: 0
      },
      like: false
    };
  },

  mounted() {
    this.getPostReview();
    this.getComment();
  },
  methods: {
    getImgUrl(i) {
      return this.post_review.post_review_images[i].link;
    },
    async getPostReview() {
      PostReviewServices.getPostReview(this.$route.params.post_id).then(
        response => {
          this.post_review = response;
          console.log($(".post_review_content span"));
          // $(".post_review_content span").forEach(element => {
          //   debugger;
          //   element;
          //   // element.style.color =
          // });
        }
      );
    },
    async getComment() {
      CommentServices.getComment(this.$route.params.post_id).then(response => {
        this.comments = response.data;
      });
    },
    likeComment(comment_id, status) {
      this.actionComment.status = status;
      this.actionComment.comment_id = comment_id;
      CommentServices.likeComment(this.actionComment).then(response => {
        if (response) {
          this.getComment();
        }
      });
    },
    commetPostReview(comment_id, $event) {
      if ($event !== null) {
        this.commentData.content = $($event.target[0]).val();
      }
      this.commentData.parent_id = comment_id;
      CommentServices.commetPostReview(this.commentData).then(response => {
        this.commentData.content = "";
        this.getComment();
      });
    },
    styleLike(like, user_id) {
      for (let index = 0; index < like.length; index++) {
        if (like[index]["user_id"] === user_id && like[index]["status"] === 1) {
          return "text-blue";
        }
      }
    },
    styleDisLike(dislike, user_id) {
      for (let index = 0; index < dislike.length; index++) {
        if (
          dislike[index]["user_id"] === user_id &&
          dislike[index]["status"] === -1
        ) {
          return "text-danger";
        }
      }
    }
  },
  computed: mapState(["userStore"])
};
</script>


<style scoped>
/* For demo */
.ant-carousel >>> .slick-dots {
  height: auto;
}
.ant-carousel >>> .slick-slide img {
  border: 5px solid #fff;
  display: block;
  margin: auto;
  max-width: 80%;
}
.ant-carousel >>> .slick-thumb {
  bottom: -45px;
}
.ant-carousel >>> .slick-thumb li {
  width: 60px;
  height: 45px;
}
.ant-carousel >>> .slick-thumb li img {
  width: 100%;
  height: 100%;
  filter: grayscale(100%);
}
.ant-carousel >>> .slick-thumb li.slick-active img {
  filter: grayscale(0%);
}
.text-blue {
  color: rgb(32, 120, 244) !important;
  font-weight: 800 !important;
}
.text-danger {
  color: #e3342f !important;
  font-weight: 800 !important;
}
</style>