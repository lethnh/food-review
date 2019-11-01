<template>
  <ValidationProvider class="py-5">
    <ValidationObserver
      class="panel p-3 mb-0"
      v-slot="{ passes }"
      ref="postReviewForm"
      tag="form"
      @submit.prevent="postReview()"
    >
      <h4>Tạo bài viết</h4>
      <hr />
      <!--  -->
      <ValidationProvider name="title" rules="required">
        <div slot-scope="{ errors }">
          <div class="form-group">
        <label>Tiêu đề</label>     <span :class="{'is-danger': errors[0]}">{{ errors[0] }}</span>
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
            <button class="btn mt-2" @click="removeAllFiles">Remove All Files</button>
          </div>
        </div>
      </ValidationProvider>
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
         <TravelMap class="travel-map" />
      <div v-if="isShow">
        <div class="form-group">
          <label>Tên nhà hàng</label>
          <input type="text" class="form-control" />
        </div>
        <!--  -->
        <div class="form-group">
          <label>Tag</label>
          <vue-tags-input
            style="max-width:100%"
            @tags-changed="newTags => tags = newTags"
            v-model="tag"
            :tags="tags"
          />
        </div>
        <!--  -->
        <!--  -->
        <ValidationProvider name="begintime" rules="required">
          <div slot-scope="{ errors }">
            <div class="form-group">
              <TimePicker format="HH:mm" v-model="post_review.begin_time" @change="onChange"></TimePicker>
              <TimePicker format="HH:mm" v-model="post_review.close_time" @change="onChange"></TimePicker>
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
              <a-select class="w-100" v-model="post_review.shop_id" @change="handleChange">
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

      <button class="btn btn-success">Tạo bài</button>
    </ValidationObserver>
  </ValidationProvider>
</template>
<script>
import TravelMap from "../../js/components/TravelMap";
import PostReviewService from "../../../js/services/PostReview";
import ShopService from "../../../js/services/Shop";
import vue2Dropzone from "vue2-dropzone";
import VueTagsInput from "@johmun/vue-tags-input";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import moment from "moment";
// import TimePicker from 'ant-design-vue/lib/timepicker';
// import 'ant-design-vue/lib/timepicker/style';

export default {
  components: {
    vueDropzone: vue2Dropzone,
    VueTagsInput,
    TravelMap,
  },
  data() {
    return {
      shops: [],
      post_review: {
        title:"",
        images: [],
        content: "",
        begin_time: null,
        close_time: null,
        money: null,
        shop_id: "",
        stars: 0,
        tags: {}
      },
      isShow: false,
      selected: 0,
      options: [
        { text: "Chọn cửa hàng có sắn", value: 0 },
        { text: "Tạo mới nhà hàng", value: 1 }
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
  },
  methods: {
    getShops() {
      ShopService.getShops().then(response => {
        this.shops = response;
      });
    },
    handleChange(value) {
      console.log(`selected ${value}`);
    },
    async postReview() {
      const isValid = await this.$refs.postReviewForm.validate();
      if (!isValid) {
        window.scroll({
          top: 10,
          behavior: "smooth"
        });
        event.preventDefault();
      } else {
        this.post_review.tags = this.tags;
        PostReviewService.storePostReview(this.post_review).then(response => {
          if (response.status === 200) {
            console.log(response.data);
            this.$router.push({
              name: "postReviewDetail",
              params: { post_id: response.data.id }
            });
          }
        });
      }
    },

    onChange(time) {
      console.log(time);
      console.log(moment(time).format("HH:mm"));
      // this.value = moment(time).format("HH:mm");
    },

    onShow(checked) {
      checked === 1 ? (this.isShow = true) : (this.isShow = false);
    },

    showError(file, message, xhr) {
      // console.log(message);
      // window.toastr["error"](message, "Error");
    },

    afterCompleteImagePost(file) {
      if (file.dataURL) {
        this.post_review.images.push(file.dataURL);
        this.images.push(file.dataURL);
      }
    },

    removeAllFiles() {
      this.$refs.dropzone.removeAllFiles();
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
<style>
.ql-container {
  min-height: 350px !important;
}
</style>