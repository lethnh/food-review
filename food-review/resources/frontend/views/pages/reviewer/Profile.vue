<template>
  <div class="row page-profile py-5">
    <section class="col-3">
      <div class="card card-shadow text-center">
        <div class="card-block">
          <a class="avatar avatar-lg" href>
            <img src="https://picsum.photos/100/100" class="rounded-circle" alt="..." />
            <input type="file" />
          </a>
          <h4 class="profile-user">{{userStore.authUser.user_info.name}}</h4>
          <p class="profile-job">Art director</p>
          <p>
            Hi! I'm Adrian the Senior UI Designer at AmazingSurge. We hope
            you enjoy the design and quality of Social.
          </p>
          <div class="profile-social">
            <a class="icon bd-twitter" href="javascript:void(0)"></a>
            <a class="icon bd-facebook" href="javascript:void(0)"></a>
            <a class="icon bd-dribbble" href="javascript:void(0)"></a>
            <a class="icon bd-github" href="javascript:void(0)"></a>
          </div>
          <button type="button" class="btn btn-primary">Follow</button>
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
              <b-card-text>Bài viết của tôi</b-card-text>
            </b-tab>
            <b-tab title="Cập nhập thông tin">
              <b-card-text>Tab Contents 2</b-card-text>
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
export default {
  data() {
    return {};
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
</style>