<template>
  <div class="py-5">
    <ckeditor v-model="editorData" ></ckeditor>
    <form class="panel p-3 mb-0">
      <div class="form-group">
        <label for="exampleFormControlInput1">Email address</label>
        <input
          type="email"
          class="form-control"
          id="exampleFormControlInput1"
          placeholder="name@example.com"
        />
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <select class="form-control" id="exampleFormControlSelect1">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect2">Example multiple select</label>
        <select multiple class="form-control" id="exampleFormControlSelect2">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
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
      // editor: ClassicEditor,
      editorData: "<p>Content of the editor.</p>",
  //     editorConfig: {
  //   // 	toolbar : [ 'Source', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'Outdent', 'Indent',
	// 	// 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',
	// 	// 'Styles', 'Format', 'Font', 'FontSize',
	// 	// 'Image', 'Embed', 'Table', '-', 'Link', 'Youtube', 'EmojiPanel', 'HKemoji', 'TextColor', 'BGColor',
  //    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote','highlight ','undo', 'redo' ],
  //     heading: {
  //           options: [
  //               { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
  //               { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
  //               { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
  //           ]
  //       }
  //   // ['MediaManager', 'FinderImages', 'Headerbox' ]

	// // config.toolbar_Full = [
	// // 	{ name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source'] },
	// // 	{ name: 'clipboard', groups: ['clipboard', 'undo'], items: ['Cut', 'Copy', 'Undo', 'Redo'] },
	// // 	{ name: 'editing', groups: ['find', 'selection'], items: ['Find', 'Replace', 'SelectAll'] },
	// // 	{ name: 'insert', items: ['Image', 'Embed', 'EmojiPanel', 'HKemoji', 'Youtube', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'] },
	// // 	{ name: 'gisoft', items: ['MediaManager', 'FinderImages', 'Headerbox']},
	// // 	'/',
	// // 	{ name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript','-', 'CopyFormatting', 'RemoveFormat'] },
	// // 	{ name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl'] },
	// // 	{ name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
	// // 	{ name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
	// // 	{ name: 'colors', items: ['TextColor', 'BGColor'] },
	// // 	{ name: 'tools', items: ['UIColor', 'Maximize', 'ShowBlocks'] },
	// // ];
  //     },
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