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
                        <div class="col-5">
                            <img
                                src="https://picsum.photos/500/500"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-7">
                            <div class="shop-rate">
                                <Rate default="5" disable allowHalf />
                                <span>5</span>
                            </div>
                            <div>
                                Giá tiền : 10000
                            </div>
                            <div>
                                Địa chỉ : 1111111111111111
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
            shop_info: {},
            post_reviews: {},
            comments: {},
            images: {}
        };
    },
    mounted() {},
    methods: {}
};
</script>
