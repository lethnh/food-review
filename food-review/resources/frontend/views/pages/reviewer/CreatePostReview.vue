<template>
  <div class="pb-5">
      <loading
      :active.sync="isLoading"
      :color="color"
      :width="width"
      :height="height"
      :isFullPage="isFullPage"
      :backgroundColor="backgroundColor"
      :opactiy="opacity"
    ></loading>
    <ValidationProvider>
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
                @vdropzone-removed-file="removeFile"
                @vdropzone-complete="afterCompleteImagePost"
              ></vue-dropzone>
              <button class="btn mt-2" @click.prevent="removeAllFiles">Remove All Files</button>
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
        <div>
          <div v-show="isShow">
            <div class="form-group">
              <label>Tên nhà hàng</label>
              <input type="text" class="form-control" v-model="post_review.shop_name" />
            </div>
            <!--  -->
            <!--  -->
            <!-- <ValidationProvider name="begintime" rules="required">
              <div slot-scope="{ errors }">
            <div class="form-group">-->
            <div class="form-group">
              <TimePicker format="HH:mm" @change="onChangeBeginTime"></TimePicker>
              <!-- v-model="post_review.begin_time" -->
              <!-- v-model="post_review.close_time" -->
              <TimePicker format="HH:mm" @change="onChangeCloseTime"></TimePicker>
            </div>
            <!-- </div> -->
            <!-- </div> -->
            <!-- </ValidationProvider> -->
            <div class="form-group">
              <gmap-autocomplete
                class="form-control"
                placeholder="Chọn địa điểm quán ăn"
                @place_changed="setPlace"
                style="min-width:250px"
              ></gmap-autocomplete>
              <!-- <button @click="usePlace">Add</button> -->
              <br />

              <Gmap-Map
                style="min-width: 600px; height: 500px;"
                :zoom="zoom"
                :center="{lat: place === null? 14.058324 : place.geometry.location.lat(), lng: place === null? 108.277199 : place.geometry.location.lng()}"
              >
                <gmap-info-window
                  :options="infoOptions"
                  :position="infoWindowPos"
                  :opened="infoWinOpen"
                ></gmap-info-window>
                <Gmap-Marker
                  v-if="place === null? false : true"
                  :zoom="zoom"
                  :clickable="true"
                  @click="toggleInfoWindow(marker)"
                  :position="{
          lat: place.geometry.location.lat(),
          lng: place.geometry.location.lng(),
        }"
                ></Gmap-Marker>
              </Gmap-Map>
            </div>
            <!--  -->
          </div>
          <div v-if="isShow === false">
            <!--  -->
            <ValidationProvider name="content" rules="required">
              <div slot-scope="{ errors }">
                <div class="form-group">
                  <span :class="{'is-danger': errors[0]}">{{ errors[0] }}</span>
                  <a-select class="w-100" v-model="post_review.shop_id" @change="handleChange">
                    <a-select-option v-for="(item, index) in shops" :key="item.id">{{ item.name }} - {{ item.address }}</a-select-option>
                  </a-select>
                </div>
              </div>
            </ValidationProvider>
            <!--  -->
          </div>
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
  </div>
</template>
<script>
// import TravelMap from "../../js/components/TravelMap";
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
    VueTagsInput
    // TravelMap
  },
  data() {
    return {
         color: "#267BFF",
      isFullPage: true,
      width: 75,
      height: 85,
      opacity: 0.5,
      zIndex: 999,
      backgroundColor: "#808080",
      loader: "spinner",

      isLoading: false,
      infoWindowPos: null,
      infoWinOpen: true,
      currentMidx: null,
      infoOptions: {
        content: "",
        pixelOffset: {
          width: 0,
          height: -35
        }
      },
      marker: {
        position: {
          lat: null,
          lng: null
        },
        infoText: ""
      },
      zoom: 5,
      place: null,
      shops: [],
      post_review: {
        shop_name: "",
        shop_image: null,
        shop_lat: null,
        shop_lng: null,
        shop_address: null,
        shop_district: null,
        shop_city: null,
        shop_google_map_id: "",
        shop_lng: null,
        shop_type: null,
        title: "",
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
        { text: "Chọn cửa hàng từ bản đồ", value: 1 }
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
        this.isLoading = true;
        PostReviewService.storePostReview(this.post_review).then(response => {
              this.isLoading = false;
          if (response.status === 200) {
            console.log(response.data);
            this.$router.push({
              name: "profile",
            });
          }
        });
      }
    },

    // onChange(time) {
    //   return moment(time).format("HH:mm"));
    //   // this.value = moment(time).format("HH:mm");
    // },
    onChangeBeginTime(time, timeString) {
      this.post_review.begin_time = timeString;
    },
    onChangeCloseTime(time, timeString) {
      this.post_review.close_time = timeString;
    },

    onShow(checked) {
      if (checked === 1) {
        this.post_review.shop_id = "";
      }
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
      (this.post_review.images = []),
        (this.images = []),
        this.$refs.dropzone.removeAllFiles();
    },

    removeFile(file, error, xhr) {
      for (let index = 0; index < this.post_review.images.length; index++) {
        if (this.post_review.images[index] === file.dataURL) {
          this.post_review.images.splice(index, 1);
        }
      }
    },

    setPlace(place) {
      this.place = place;
      this.zoom = 17;
      this.marker.position.lat = place.geometry.location.lat();
      this.marker.position.lng = place.geometry.location.lng();
      this.marker.infoText = place.adr_address;
      this.post_review.shop_name = place.name;
      this.post_review.shop_lat = place.geometry.location.lat();
      this.post_review.shop_lng = place.geometry.location.lng();
      this.post_review.shop_address = place.formatted_address;
      this.post_review.shop_google_map_id = place.id;
      this.post_review.shop_type = place.types[0];
      this.post_review.shop_image = place.photos
        ? place.photos[0].getUrl()
        : null;
      place.address_components.forEach(element => {
        if (element.types[0] === "administrative_area_level_1") {
          this.post_review.shop_city = element.long_name;
        }
        if (element.types[0] === "administrative_area_level_2") {
          this.post_review.shop_district = element.long_name;
        }
      });
    },
    toggleInfoWindow: function(marker) {
      this.infoWindowPos = marker.position;
      this.infoOptions.content = marker.infoText;
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