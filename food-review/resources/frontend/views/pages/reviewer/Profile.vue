<template>
  <div class="row page-profile">
    <section class="col-3">
      <div class="card card-shadow text-center">
        <div class="card-block">
          <form enctype="multipart/form-data">
            <a class="avatar avatar-lg" href>
              <img
                v-if="user.avatar !== null"
                :src="user.avatar"
                alt
                style="height:100px;width:100px"
              />
              <img v-else src="/images/5.jpg" class="rounded-circle" alt="..." />
            </a>
            <h4 class="profile-user">{{userStore.authUser.user_info.name}}</h4>
            <!-- <p class="profile-job">Art director</p> -->
            <button @click="chooseImage" class="btn btn-primary" type="button">Cập nhập ảnh đại diện</button>
            <input type="file" v-on:change="onImageChange" class="d-none" ref="fileInput" />
          </form>
          <!-- <p>
            Hi! I'm Adrian the Senior UI Designer at AmazingSurge. We hope
            you enjoy the design and quality of Social.
          </p>-->
          <div class="profile-social">
            <a class="icon bd-twitter" href="javascript:void(0)"></a>
            <a class="icon bd-facebook" href="javascript:void(0)"></a>
            <a class="icon bd-dribbble" href="javascript:void(0)"></a>
            <a class="icon bd-github" href="javascript:void(0)"></a>
          </div>
        </div>
        <div class="card-footer">
          <div class="row no-space">
            <div class="col-6">
              <strong class="profile-stat-count">260</strong>
              <span>Follower</span>
            </div>
            <div class="col-6">
              <strong class="profile-stat-count">180</strong>
              <span>Following</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="col-9">
      <div class="panel">
        <b-card no-body>
          <b-tabs card>
            <b-tab title="Bài viết của tôi" active>
              <div class="row">
                <div class="col-12" v-for="(post, index) in post_reviews" :key="index">
                  <div class="post-item">
                    <router-link
                      v-if="post.feature_image !== null"
                      :to="{ name: 'postReviewDetail', params: { post_id: post.id }}"
                    >
                      <img :src="post.feature_image" class="mr-3 img-fluid" alt="..." />
                    </router-link>
                    <router-link
                      v-else
                      :to="{ name: 'postReviewDetail', params: { post_id: post.id }}"
                    >
                      <img src="/images/noimage.png" class="mr-3 img-fluid" alt="..." />
                    </router-link>
                    <div class="post-body">
                      <router-link :to="{ name: 'postReviewDetail', params: { post_id: post.id }}">
                        <h5>{{ post.title }}</h5>
                      </router-link>
                      <div>{{ post.money | currency}}</div>
                      <Rate :defaultValue="post.stars" allowHalf />
                      <span>{{ post.stars }} sao</span>
                      <div class="action mt-2">
                        <div>
                          <i class="fas fa-thumbs-up"></i>
                        </div>
                        <div>
                          <i class="fas fa-thumbs-down"></i>
                        </div>
                        <div>
                          <i class="fas fa-comment-dots"></i>
                        </div>
                      </div>
                      <div></div>
                    </div>
                  </div>
                </div>
              </div>
            </b-tab>
            <b-tab title="Cập nhập thông tin">
              <form @submit.prevent="updateUser()">
                <div class="row">
                  <div class="form-group col-6">
                    <label for>Email</label>
                    <input type="text" v-model="user.email" disabled class="form-control" />
                  </div>
                  <div class="form-group col-6">
                    <label for>Tên</label>
                    <input type="text" v-model="user.name" class="form-control" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for>Số điện thoại</label>
                    <input type="text" v-model="user.phone_number" class="form-control" />
                  </div>
                  <div class="form-group col-6">
                    <label for>Địa chỉ</label>
                    <input type="text" v-model="user.address" class="form-control" />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label for>Tuổi</label>
                    <input type="number" v-model="user.age" min="10" max="100" class="form-control" />
                  </div>
                  <div class="form-group col-6">
                    <label for>Thành phố</label>
                    <input type="text" v-model="user.city_id" class="form-control" />
                  </div>
                </div>
                <button class="btn btn-primary">Cập nhập</button>
              </form>
            </b-tab>
            <b-tab title="Bình luận của tôi">
              <b-card-text>Tab Contents 2</b-card-text>
            </b-tab>
          </b-tabs>
        </b-card>
      </div>
    </section>
  </div>
</template>
<script>
import { mapState } from "vuex";
import Swal from "sweetalert2";
import "sweetalert2/src/sweetalert2.scss";
import AuthServices from "../../../js/services/Auth";
export default {
  data() {
    return {
      user: {},
      post_reviews: {},
      comments: {},
      avatar: null
    };
  },
  mounted() {
    this.getUser();
    this.getMyPostReview();
  },
  methods: {
    async getUser() {
      AuthServices.getUser().then(response => {
        this.user = response;
      });
    },
    async getMyPostReview() {
      AuthServices.getMyPostReview().then(response => {
        this.post_reviews = response;
      });
    },
    async getMyComment() {
      AuthServices.getMyComment().then(response => {
        this.comments = response;
      });
    },
    chooseImage() {
      this.$refs.fileInput.click();
    },
    onImageChange() {
      let vm = this;
      let data = new FormData();
      this.avatar = event.target.files[0];
      data.set("avatar", this.avatar);
      Swal.fire({
        title: "Bạn muốn thay đổi ảnh đại diện không ?",
        type: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Quay lại",
        showCloseButton: true
      }).then(result => {
        if (result.value) {
          AuthServices.uploadAvatar(data).then(response => {
            if (response) {
              Swal.fire({
                type: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500
              });
              console.log(response);
              let authUser = localStorage.getItem("authUser");
              const userObj = JSON.parse(authUser);
              userObj.user_info.avatar = response.avatar;
              localStorage.setItem("authUser", JSON.stringify(userObj));
              this.$store.dispatch("setUserObject", userObj);
              this.user = response;
            } else {
              Swal("Xin lỗi", "Cập nhật thất bại", "error");
            }
          });
        }
      });
    },
    updateUser() {
      AuthServices.editUser(this.user).then(response => {
        this.user = response;
      });
    }
  },
  computed: mapState(["userStore"])
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
.card {
  border: none;
}
.page-profile .card-block {
  padding: 40px 15px;
  background-color: #fff;
}
.page-profile .card .avatar {
  width: 130px;
  margin-bottom: 10px;
}
.avatar {
  position: relative;
  display: inline-block;
  width: 40px;
  white-space: nowrap;
  vertical-align: bottom;
}
.page-profile .profile-user {
  margin-bottom: 10px;
  color: #263238;
}
.page-profile .profile-job {
  margin-bottom: 20px;
  color: #a3afb7;
}
.page-profile .profile-social {
  margin: 25px 0;
}
.card-shadow {
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}
i {
  cursor: pointer;
}
.img-avatar {
  height: 45px;
  width: 45px;
}
.avatar-hv:hover .overlay-effect {
  opacity: 1;
  cursor: pointer;
}
.icon-upload {
  display: none;
  top: 75%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 9999;
  transition: 0.5s ease;
}
.avatar-hv:hover .icon-upload {
  display: block !important;
}
.overlay-effect {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  opacity: 0;
  transition: 0.5s ease;
  background-color: rgba(255, 255, 255, 0.7);
  overflow: hidden;
  border-bottom-left-radius: 50%;
  border-bottom-right-radius: 50%;
}
</style>