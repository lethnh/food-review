<template>
  <div class="py-5">
    <form class="panel p-3 mb-0">
      <h4>Tạo bài viết</h4>
      <hr />
      <div class="form-group">
        <label>Ảnh ( tối đa năm ảnh )</label>
        <vue-dropzone ref="dropzone" id="dropzone" :options="post_review.dropzoneOptions"></vue-dropzone>
        <!-- @vdropzone-error="showError"
        @vdropzone-complete="afterCompleteImagePost"-->
      </div>
      <div class="form-group">
        <label>Giá tiền trung bình / một người</label>
        <currency-input
          class="form-control border"
          v-model="post_review.money"
          currency="VND"
          locale="vn"
          :distraction-free="distractionFree"
        />
      </div>
      <div class="form-group">
        <label>Đánh giá sao</label>
        <Rate :allowClear="false" v-model="post_review.stars"></Rate>
        <!-- <star-rating v-bind:increment="0.5" v-bind:star-size="50"></star-rating> -->
      </div>
      <div class="form-group">
        <label>Nội dung</label>
        <quill-editor name="description"></quill-editor>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Địa chỉ quán ăn, nhà hàng</label>
        <b-form-radio-group
          v-model="post_review.selected"
          :options="post_review.options"
          name="radio-inline"
          @change="onShow"
        ></b-form-radio-group>
      </div>
      <div v-if="isShow">
        <div class="form-group">
          <label>Tên nhà hàng</label>
          <input type="text" class="form-control" />
        </div>
        <div class="form-group">
          <label>Tag</label>
          <vue-tags-input
            style="max-width:100%"
            @tags-changed="newTags => tags = newTags"
            v-model="post_review.tag"
            :tags="post_review.tags"
          />
        </div>
        <div class="form-group">
          <TimePicker format="HH:mm" v-model="post_review.value" @change="onChange"></TimePicker>
          <!-- <TimePicker format="HH:mm" v-model="value2" @change="onChange"></TimePicker> -->
        </div>
      </div>
      <button type="button" class="btn btn-success">Tạo bài</button>
    </form>
  </div>
</template>
<script>
import PostReview from '../../../js/services/PostReview';
import vue2Dropzone from "vue2-dropzone";
import VueTagsInput from "@johmun/vue-tags-input";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import moment from "moment";
// import TimePicker from 'ant-design-vue/lib/timepicker';
// import 'ant-design-vue/lib/timepicker/style';

export default {
  components: {
    vueDropzone: vue2Dropzone,
    VueTagsInput
  },
  data() {
    return {
      post_review: {
        selected: 0,
        options: [
          { text: "Chọn cửa hàng có sắn", value: 0 },
          { text: "Tạo mới nhà hàng", value: 1 }
        ],
        begin_time: null,
        close_time: null,
        money: 0,
        stars: 0,
        tag: "",
        tags: [],
        cities: [],
        dropzoneOptions: {
          url: "https://httpbin.org/post",
          addRemoveLinks: true,
          autoProcessQueue: true,
          uploadMultiple: true,
          thumbnailWidth: 150,
          parallelUploads: 10,
          maxFiles: 10,
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
      },
      isShow: false
    };
  },
  methods: {
    onChange(time) {
      console.log(time);
      console.log(moment(time).format("HH:mm"));
      // this.value = moment(time).format("HH:mm");
    },
    onShow(checked) {
      checked === 1 ? (this.isShow = true) : (this.isShow = false);
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
  height: 350px !important;
}
</style>