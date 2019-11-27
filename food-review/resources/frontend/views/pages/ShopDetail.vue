<template>
    <div>
        <loading
            :active.sync="isLoading"
            :color="color"
            :width="width"
            :height="height"
            :isFullPage="isFullPage"
            :backgroundColor="backgroundColor"
            :opactiy="opacity"
        ></loading>
        <section>
            <div class="section-content">
                <div class="panel">
                    <div class="row mb-3 p-2">
                        <div class="col-6">
                            <img
                                src="https://picsum.photos/500/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-6">
                            <h5>
                                {{ shop_info.name }}
                            </h5>
                            <div class="shop-rate">
                                <Rate
                                    disabled
                                    v-model="shop_info.stars"
                                    allowHalf
                                />
                                <span>{{ shop_info.stars }}</span>
                            </div>
                            <div>
                                Giá tiền : <i class="fas fa-money-bill"></i>
                                <span>{{ shop_info.money | currency }}</span>
                            </div>
                            <div>
                                Địa chỉ : <i class="fas fa-map-marker-alt"></i>
                                <a
                                    v-bind:href="url(shop_info.address)"
                                    target="_blank"
                                >
                                    <span> {{ shop_info.address }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="section-title bg-white">
                <h5 class="p-2">Ảnh về cửa hàng</h5>
            </div>
            <div class="section-content m-t-20">
                <div class="list-shops panel">
                    <div class="row p-2">
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="section-title bg-white">
                <h5 class="p-2">Bài viết về cửa hàng</h5>
            </div>
            <div class="section-content m-t-20">
                <div class="list-post panel">
                    <div class="row p-2">
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="section-title bg-white">
                <h5 class="p-2">Bình luận về cửa hàng</h5>
            </div>
            <div class="section-content m-t-20">
                <div class="list-comment panel">
                    <div class="row p-2">
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="section-title bg-white">
                <h5 class="p-2">Cửa hàng liên quan</h5>
            </div>
            <div class="section-content m-t-20">
                <div class="list-comment panel">
                    <div class="row p-2">
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-md-3">
                            <img
                                src="https://picsum.photos/600/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import ShopService from "../../js/services/Shop";
export default {
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
            shop_info: {},
            shop_relate: {},
            post_reviews: {},
            comments: {},
            images: {},
            shop_id: this.$route.params.shop_id
        };
    },
    mounted() {
        this.getShop();
        this.getShopImages();
        this.getShopComments();
        this.getShopListPost();
        this.getShopRelate();
    },
    methods: {
        url(address) {
            return `http://maps.google.com/?q=${address}`;
        },
        // async getShopImages() {
        //     ShopService.getShopImages(this.shop_id).then(response => {
        //         this.images = response.data;
        //     });
        // },
        // async getShopComments() {
        //     ShopService.getShopComments(this.shop_id).then(response => {
        //         this.comments = response.data;
        //     });
        // },
        // async getShopRelate() {
        //     ShopService.getShopRelate(this.shop_id).then(response => {
        //         this.shop_relate = response.data;
        //     });
        // },
        async getShop() {
            this.isLoading = true;
            ShopService.getShop(this.shop_id).then(response => {
                this.isLoading = false;
                this.shop_info = response.data;
            });
        }
        // async getShopListPost() {
        //     ShopService.getShopListPost(this.shop_id).then(response => {
        //         this.post_reviews = response.data;
        //     });
        // }
    }
};
</script>
