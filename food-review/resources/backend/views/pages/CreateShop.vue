<template>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Example Panel With Heading -->
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tạo cửa hàng</h3>
                    </div>
                    <div class="panel-body">
                        <ValidationProvider>
                            <ValidationObserver
                                class="panel p-3 mb-0"
                                v-slot="{ passes }"
                                ref="shopForm"
                                tag="form"
                                @submit.prevent="createShop()"
                            >
                                <ValidationProvider
                                    name="images"
                                    rules="required"
                                >
                                    <div slot-scope="{ errors }">
                                        <div class="form-group">
                                            <label
                                                >Ảnh ( tối đa năm ảnh )</label
                                            >
                                            <span
                                                :class="{
                                                    'is-danger': errors[0]
                                                }"
                                                >{{ errors[0] }}</span
                                            >
                                            <vue-dropzone
                                                ref="dropzone"
                                                id="dropzone"
                                                v-model="images"
                                                :options="dropzoneOptions"
                                                @vdropzone-error="showError"
                                                @vdropzone-removed-file="
                                                    removeFile
                                                "
                                                @vdropzone-complete="
                                                    afterCompleteImagePost
                                                "
                                            ></vue-dropzone>
                                            <button
                                                class="btn mt-2"
                                                @click.prevent="removeAllFiles"
                                            >
                                                Remove All Files
                                            </button>
                                        </div>
                                    </div>
                                </ValidationProvider>
                                <ValidationProvider
                                    name="name"
                                    rules="required"
                                >
                                    <div slot-scope="{ errors }">
                                        <div class="form-group">
                                            <label>Tên nhà hàng</label>
                                            <span
                                                :class="{
                                                    'is-danger': errors[0]
                                                }"
                                                >{{ errors[0] }}</span
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="shop.shop_name"
                                            />
                                        </div>
                                    </div>
                                </ValidationProvider>
                                <!--  -->
                                <!--  -->
                                <!-- <ValidationProvider name="begintime" rules="required">
              <div slot-scope="{ errors }">
            <div class="form-group">-->
                                <div class="form-group">
                                    <TimePicker
                                        format="HH:mm"
                                        @change="onChangeBeginTime"
                                    ></TimePicker>
                                    <!-- v-model="shop.begin_time" -->
                                    <!-- v-model="shop.close_time" -->
                                    <TimePicker
                                        format="HH:mm"
                                        @change="onChangeCloseTime"
                                    ></TimePicker>
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
                                        :center="{
                                            lat:
                                                place === null
                                                    ? 14.058324
                                                    : place.geometry.location.lat(),
                                            lng:
                                                place === null
                                                    ? 108.277199
                                                    : place.geometry.location.lng()
                                        }"
                                    >
                                        <gmap-info-window
                                            :options="infoOptions"
                                            :position="infoWindowPos"
                                            :opened="infoWinOpen"
                                        ></gmap-info-window>
                                        <Gmap-Marker
                                            v-if="place === null ? false : true"
                                            :zoom="zoom"
                                            :clickable="true"
                                            @click="toggleInfoWindow(marker)"
                                            :position="{
                                                lat: place.geometry.location.lat(),
                                                lng: place.geometry.location.lng()
                                            }"
                                        ></Gmap-Marker>
                                    </Gmap-Map>
                                </div>
                                <div class="form-group">
                                    <label>Tag</label>
                                    <vue-tags-input
                                        style="max-width:100%"
                                        @tags-changed="
                                            newTags => (tags = newTags)
                                        "
                                        v-model="tag"
                                        :tags="tags"
                                    />
                                </div>
                                <button class="btn btn-primary">Tạo</button>
                            </ValidationObserver>
                        </ValidationProvider>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import VueTagsInput from "@johmun/vue-tags-input";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import ShopService from "../../js/services/Shop";
import moment from "moment";
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
            shop: {
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
                begin_time: null,
                close_time: null,
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
    mounted() {},
    methods: {
        handleChange(value) {
            console.log(`selected ${value}`);
        },
        async createShop() {
            const isValid = await this.$refs.shopForm.validate();
            if (!isValid) {
                window.scroll({
                    top: 10,
                    behavior: "smooth"
                });
                event.preventDefault();
            } else {
                this.shop.tags = this.tags;
                this.isLoading = true;
                ShopService.createShop(this.shop).then(response => {
                    this.isLoading = false;
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
        onChangeBeginTime(time, timeString) {
            this.shop.begin_time = timeString;
        },
        onChangeCloseTime(time, timeString) {
            this.shop.close_time = timeString;
        },

        onShow(checked) {
            if (checked === 1) {
                this.shop.shop_id = "";
            }
            checked === 1 ? (this.isShow = true) : (this.isShow = false);
        },

        showError(file, message, xhr) {
            // console.log(message);
            // window.toastr["error"](message, "Error");
        },

        afterCompleteImagePost(file) {
            if (file.dataURL) {
                this.shop.images.push(file.dataURL);
                this.images.push(file.dataURL);
            }
        },

        removeAllFiles() {
            (this.shop.images = []),
                (this.images = []),
                this.$refs.dropzone.removeAllFiles();
        },

        removeFile(file, error, xhr) {
            for (let index = 0; index < this.shop.images.length; index++) {
                if (this.shop.images[index] === file.dataURL) {
                    this.shop.images.splice(index, 1);
                }
            }
        },

        setPlace(place) {
            this.place = place;
            this.zoom = 17;
            this.marker.position.lat = place.geometry.location.lat();
            this.marker.position.lng = place.geometry.location.lng();
            this.marker.infoText = place.adr_address;
            this.shop.shop_name = place.name;
            this.shop.shop_lat = place.geometry.location.lat();
            this.shop.shop_lng = place.geometry.location.lng();
            this.shop.shop_address = place.formatted_address;
            this.shop.shop_google_map_id = place.id;
            this.shop.shop_type = place.types[0];
            this.shop.shop_image = place.photos
                ? place.photos[0].getUrl()
                : null;
            place.address_components.forEach(element => {
                if (element.types[0] === "administrative_area_level_1") {
                    this.shop.shop_city = element.long_name;
                }
                if (element.types[0] === "administrative_area_level_2") {
                    this.shop.shop_district = element.long_name;
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
