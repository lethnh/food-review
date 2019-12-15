<template>
  <ValidationProvider class="py-5">
    <ValidationObserver
      class="panel p-3 mb-0"
      v-slot="{ passes }"
      ref="editPostReviewForm"
      tag="form"
      @submit.prevent="editPostReview()"
    >
      <h4>Tạo bài viết</h4>
      <hr />
      <!--  -->
      <ValidationProvider name="title" rules="required">
        <div slot-scope="{ errors }">
          <div class="form-group">
            <label>Tiêu đề</label>
            <span :class="{'is-danger': errors[0]}">{{ errors[0] }}</span>
            <input type="text" class="form-control" v-model="post_review.title" />
          </div>
        </div>
      </ValidationProvider>

      <ValidationProvider name="images" rules="required">
        <div slot-scope="{ errors }">
          <div class="form-group">
            <label>Ảnh ( tối đa năm ảnh )</label>
            <span :class="{'is-danger': errors[0]}">{{ errors[0] }}</span>
            <vue-dropzone
              ref="dropzone"
              id="dropzone"
              v-model="images"
              :options="dropzoneOptions"
              @vdropzone-error="showError"
              @vdropzone-complete="afterCompleteImagePost"
            ></vue-dropzone>
            <!-- <button class="btn mt-2" @click="removeAllFiles">Remove All Files</button> -->
          </div>
        </div>
      </ValidationProvider>
      <div class="mb-3">
        <div>Ảnh</div>
        <div class="d-flex flex-wrap">
          <div
            class="edit mr-2"
            v-for="(image, index) in post_review.post_review_images"
            :key="index"
          >
            <div class="overlay"></div>
            <img :src="image.link" alt class="edit_image" />
            <i class="fas fa-window-close" @click="deleteImage(image.link)"></i>
          </div>
        </div>
      </div>
      <!--  -->

      <!--  -->
      <div class="form-group">
        <label for="exampleFormControlSelect1">Địa chỉ quán ăn, nhà hàng</label>
        <b-form-radio-group
          v-model="selected"
          :options="options"
          name="radio-inline"
          @change="onShow"
        ></b-form-radio-group>
      </div>
      <!--  -->
      <div v-if="isShow === true">
        <div class="form-group">
          <label>Tên nhà hàng</label>
          <input type="text" class="form-control" v-model="post_review.shop.name" />
        </div>
        <!--  -->
        <ValidationProvider name="begintime" rules="required">
          <div slot-scope="{ errors }">
            <div class="form-group">
              <TimePicker format="HH:mm"  :defaultValue="moment(post_review.shop.begin_time, 'HH:mm')"  @change="onChangeBeginTime"></TimePicker>
              <TimePicker format="HH:mm"  :defaultValue="moment(post_review.shop.close_time, 'HH:mm')" @change="onChangeCloseTime"></TimePicker>
            </div>
          </div>
        </ValidationProvider>
        <!--  -->
      </div>
     <div v-else>
        <!--  -->
        <ValidationProvider name="content" rules="required">
          <div slot-scope="{ errors }">
            <div class="form-group">
              <span :class="{'is-danger': errors[0]}">{{ errors[0] }}</span>
              <a-select class="w-100" v-model="post_review.shop_id">
                <a-select-option v-for="(item, index) in shops" :key="item.id">{{ item.name }}</a-select-option>
              </a-select>
            </div>
          </div>
        </ValidationProvider>
        <!--  -->
      </div>

      <!--  -->
      <div class="row">
        <!--  -->
        <ValidationProvider name="money" rules="required|min_value:1" class="col-6">
          <div slot-scope="{ errors }">
            <div class="form-group">
              <label>Giá tiền trung bình / một người</label>
              <span :class="{'is-danger': errors[0]}">{{ errors[0] }}</span>
              <currency-input
                class="form-control border"
                v-model="post_review.money"
                currency="VND"
                locale="vn"
                :class="{'is-invalid': errors[0]}"
                :distraction-free="distractionFree"
              />
            </div>
          </div>
        </ValidationProvider>
        <!--  -->

        <!--  -->
        <ValidationProvider name="stars" rules="required|min_value:1" class="col-6">
          <div slot-scope="{ errors }">
            <div class="form-group">
              <label>Đánh giá sao</label>
              <div>
                <Rate :allowClear="false" v-model="post_review.stars"></Rate>
                {{post_review.stars}} sao
              </div>
              <span :class="{'is-danger': errors[0]}">{{ errors[0] }}</span>
            </div>
          </div>
        </ValidationProvider>
        <!--  -->
      </div>
      <!--  -->

      <!--  -->
      <ValidationProvider name="content" rules="required">
        <div slot-scope="{ errors }">
          <div class="form-group">
            <label>Nội dung</label>
            <span :class="{'is-danger': errors[0]}">{{ errors[0] }}</span>
            <quill-editor name="description" v-model="post_review.content"></quill-editor>
          </div>
        </div>
      </ValidationProvider>
      <!--  -->

      <button class="btn btn-success">Cập nhập bài viết</button>
    </ValidationObserver>
  </ValidationProvider>
</template>
<script>
import PostReviewService from "../../../js/services/PostReview";
import ShopService from "../../../js/services/Shop";
import vue2Dropzone from "vue2-dropzone";
import VueTagsInput from "@johmun/vue-tags-input";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import moment from "moment";
export default {
  components: {
    vueDropzone: vue2Dropzone,
    VueTagsInput
  },
  data() {
    return {
      shops: [],
      post_review: { user: {}, images: [],shop:{
        begin_time: "",
        close_time: "",
      } },
      isShow: false,
      selected: 0,
      options: [
        { text: "Chọn cửa hàng có sắn", value: 0 },
        { text: "Chỉnh sửa cửa hàng", value: 1 }
      ],
      cities: [],
      tag: "",
      tags: [],
      images: [],
      dropzoneOptions: {
        url: "https://httpbin.org/post",
        addRemoveLinks: true,
        autoProcessQueue: true,
        uploadMultiple: true,
        thumbnailWidth: 150,
        parallelUploads: 10,
        maxFiles: 5,
        thumbnailHeight: 150,
        // timeout: 180000,
        acceptedFiles: "image/*",
        dictCancelUpload: "Cancel File",
        dictDefaultMessage:
          "<i class='icon-fa icon-fa-cloud-upload'/></i> Kéo thả ảnh tải lên",
        headers: {
          // Authorization: "Bearer " + localStorage.getItem("auth.token")
        }
      }
    };
  },
  mounted() {
    this.getShops();
    this.getPostReview();
  },
  methods: {
    moment,
    getShops() {
      ShopService.getShops().then(response => {
        this.shops = response;
      });
    },
    async getPostReview() {
      PostReviewService.getPostReview(this.$route.params.post_id).then(
        response => {
          this.post_review = response;
          this.post_review.shop.begin_time = this.post_review.shop.begin_time
          this.post_review.images = [];
        }
      );
    },
    onChangeBeginTime(time, timeString) {
      this.post_review.shop.begin_time = timeString;
    },
    onChangeCloseTime(time, timeString) {
      this.post_review.shop.close_time = timeString;
    },
    onShow(checked) {
      checked === 1 ? (this.isShow = true) : (this.isShow = false);
    },
    afterCompleteImagePost(file) {
      if (file.dataURL) {
        this.post_review.images.push(file.dataURL);
        this.images.push(file.dataURL);
      }
    },
    showError(file, message, xhr) {
  
    },
    removeAllFiles() {
      this.$refs.dropzone.removeAllFiles();
    },
    deleteImage(link) {
      let vm = this;
      let data = new FormData();
      data.set("link", link);
      // debugger;
      PostReviewService.deleteImage(this.$route.params.post_id, link).then(
        response => {
          this.getPostReview();
        }
      );
    },
    async editPostReview() {
      const isValid = await this.$refs.editPostReviewForm.validate();
      if (!isValid) {
        window.scroll({
          top: 10,
          behavior: "smooth"
        });
        event.preventDefault();
      } else {
        // this.post_review.tags = this.tags;
        PostReviewService.editPostReview(
          this.$route.params.post_id,
          this.post_review
        ).then(response => {
          // if (response.status === 200) {
            this.$router.push({
              name: "postReviewDetail",
              params: { post_id: response.data.id }
            }).catch(err => {});
          // }
        });
      }
    }
  },
  computed: {
    distractionFree() {
      return {
        hideNegligibleDecimalDigits: this.hideNegligibleDecimalDigits,
        hideCurrencySymbol: this.hideCurrencySymbol,
        hideGroupingSymbol: this.hideGroupingSymbol
      };
    }
  }
};
</script>
<style lang="css" scoped>
.edit_image {
  width: 150px;
  height: 150px;
  object-fit: cover;
}
.edit {
  position: relative;
}
.edit i {
  position: absolute;
  top: 5px;
  right: 5px;
  display: none;
  z-index: 9999;
  color: white;
}
.overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0.5;
  background-color: black;
  display: none;
}
.edit:hover .overlay,
.edit:hover i {
  display: block;
  cursor: pointer;
}
</style>