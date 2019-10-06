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
        <label for="exampleFormControlSelect1">Giá tiền trung bình</label>
        <input type="number" class="form-control border" />
      </div>
      <div class="form-group">
        <label>Đánh giá sao</label>
        <star-rating v-model="rating"></star-rating>
      </div>
      <div class="form-group">
        <label>Nội dung</label>
        <quill-editor name="description"></quill-editor>
      </div>
      <!-- <div class="form-group">
        <label for="exampleFormControlSelect2">Example multiple select</label>
        <select multiple class="form-control" id="exampleFormControlSelect2">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>-->
    </form>
  </div>
</template>
<script>
// import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    return {
      cities: [],
      dropzoneOptions: {
        url: "https://httpbin.org/post",
        addRemoveLinks: true,
        autoProcessQueue: true,
        uploadMultiple: true,
        thumbnailWidth: 150,
        parallelUploads: 10, // Number of files process at a time (default 2)
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
  }
};
</script>
<style>
.ql-container {
  height: 350px !important;
}
</style>