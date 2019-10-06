<template>
  <div class="py-5">
    <form class="panel p-3 mb-0">
      <div class="form-group">
        <label>Ảnh</label>
        <vue-dropzone ref="dropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
        <!-- @vdropzone-error="showError"
        @vdropzone-complete="afterCompleteImagePost"-->
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Giá tiền trung bình / một người</label>
        <!-- <currency-input v-model="money" currency="VND" locale="vn" /> -->
        <currency-input
          class="form-control border"
          v-model="money"
          currency="VND"
          locale="vn"
          :distraction-free="distractionFree"
        />
      </div>
      <div class="form-group">
        <label>Đánh giá sao</label>
        <star-rating v-bind:increment="0.5" v-bind:star-size="50"></star-rating>
      </div>
      <div class="form-group">
        <label>Nội dung</label>
        <quill-editor name="description"></quill-editor>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Tag</label>
        <vue-tags-input
          style="max-width:100%"
          @tags-changed="newTags => tags = newTags"
          v-model="tag"
          :tags="tags"
        />
      </div>
    </form>
  </div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import VueTagsInput from "@johmun/vue-tags-input";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  components: {
    vueDropzone: vue2Dropzone,
    VueTagsInput
  },
  data() {
    return {
      money: 0,
      tag: "",
      tags: [],
      cities: [],
      dropzoneOptions: {
        url: "https://httpbin.org/post",
        addRemoveLinks: true,
        autoProcessQueue: true,
        uploadMultiple: true,
        thumbnailWidth: 150,
        parallelUploads: 10, // Number of files process at a time (default 2)
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
    };
  },
  methods: {},
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