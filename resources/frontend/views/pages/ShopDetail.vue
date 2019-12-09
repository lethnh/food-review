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
                        <div
                            class="col-6"
                            style="height:300px;overflow: hidden;"
                        >
                            <img
                                :src="shop_info.feature_image"
                                class="img-fluid"
                                alt
                            />
                        </div>
                        <div class="col-6">
                            <h5>
                                {{ shop_info.name }}
                            </h5>
                            <div class="shop-rate mb-3">
                                <Rate
                                    disabled
                                    v-model="shop_info.stars"
                                    allowHalf
                                />
                                <span>{{ shop_info.stars }}</span>
                            </div>
                            <div class="mb-3">
                                Giá tiền : <i class="fas fa-money-bill"></i>
                                <span>{{ shop_info.money | currency }}</span>
                            </div>
                            <div class="mb-3">
                                <strong>
                                    Địa chỉ
                                </strong>
                                : <i class="fas fa-map-marker-alt"></i>
                                <a
                                    v-bind:href="url(shop_info.address)"
                                    target="_blank"
                                >
                                    <span> {{ shop_info.address }}</span>
                                </a>
                            </div>
                            <div class="mb-3">
                                <strong>
                                    Số bài đánh giá :
                                </strong>
                                <i class="fas fa-newspaper"></i>
                                <span>{{ shop_info.post_reviews_count }}</span>
                            </div>
                            <div class="d-flex">
                                <strong>
                                    Tag :
                                </strong>
                                <div
                                    class="btn border ml-2"
                                    v-for="(item, index) in shop_tags"
                                    :key="index"
                                >
                                    {{ item.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="section-title bg-white">
                <h5 class="p-2">
                    Ảnh về cửa hàng ({{
                        images.length != 0 ? images.length : 0
                    }})
                </h5>
            </div>
            <div class="section-content m-t-20">
                <div class="list-shops panel">
                    <div
                        class="owl-carousel 1 owl-theme"
                        v-if="images.length != 0"
                    >
                        <div
                            class="item"
                            v-for="(item, index) in images"
                            :key="index"
                        >
                            <img
                                :src="item.link"
                                class="img-fluid"
                                alt
                                style="height:200px"
                            />
                        </div>
                    </div>
                    <div v-else>không có ảnh</div>
                </div>
            </div>
        </section>
        <section>
            <div class="section-title bg-white">
                <h5 class="p-2">
                    Bài viết về cửa hàng ({{
                        post_reviews.length != 0
                            ? post_reviews.length
                            : 0
                    }})
                </h5>
            </div>
            <div class="section-content m-t-20">
                <div class="list-post-review-top-view">
                    <div
                        class="owl-carousel 3 owl-theme"
                        v-if="shop_info.post_reviews_count != 0"
                    >
                        <div
                            class="post-item item bg-white"
                            v-for="(post, index) in post_reviews"
                            :key="index"
                        >
                            <router-link
                                v-if="post.feature_image !== null"
                                :to="{
                                    name: 'postReviewDetail',
                                    params: { post_id: post.id }
                                }"
                            >
                                <img
                                    :src="post.feature_image"
                                    class="img-fluid"
                                    alt="..."
                                />
                            </router-link>
                            <router-link
                                v-else
                                :to="{
                                    name: 'postReviewDetail',
                                    params: { post_id: post.id }
                                }"
                            >
                                <img
                                    src="/images/noimage.png"
                                    class="img-fluid"
                                    alt="..."
                                />
                            </router-link>
                            <div class="post-body p-1">
                                <router-link
                                    :to="{
                                        name: 'postReviewDetail',
                                        params: { post_id: post.id }
                                    }"
                                >
                                    <h5>{{ post.title }}</h5>
                                </router-link>

                                <div>{{ post.money | currency }}</div>
                                <div>
                                    <Rate v-model="post.stars" disabled />
                                </div>
                                <div class="action">
                                    <!-- <div>
                  <i class="fas fa-thumbs-up"></i>
                </div>
                <div>
                  <i class="fas fa-thumbs-down"></i>
                  </div>-->
                                    <div>
                                        <i class="fas fa-comment-dots"></i>
                                        {{ post.totalComment }}
                                    </div>
                                </div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div v-else>Không có bài viết</div>
                </div>
            </div>
        </section>
        <section>
            <div class="section-title bg-white">
                <h5 class="p-2">
                    Bình luận về cửa hàng ({{
                        comments.length != 0 ? comments.length : 0
                    }})
                </h5>
            </div>
            <div class="section-content m-t-20">
                <div class="list-comment panel">
                    <div
                        class="owl-carousel 2 owl-theme"
                        v-if="comments.length != 0"
                    >
                        <div
                            class="item text-center"
                            v-for="(item, index) in comments"
                            :key="index"
                        >
                            <img
                                :src="item.avatar"
                                alt=""
                                class="mx-auto mt-3 mb-2"
                                style="height:48px;width:48px"
                                v-if="item.avatar != null"
                            />
                            <img
                                src="/images/5.jpg"
                                alt=""
                                class="mx-auto mt-3 mb-2"
                                style="height:48px;width:48px"
                                v-else
                            />
                            <div>
                                <p
                                    class="text-dark pb-0"
                                    style="font-size:13px"
                                >
                                    {{ item.name }}
                                </p>
                                <p class="pb-0">{{ item.content }}</p>
                            </div>
                        </div>
                    </div>
                    <div v-else>Không có bình luận</div>
                </div>
            </div>
        </section>
        <section>
            <div class="section-title bg-white">
                <h5 class="p-2">
                    Cửa hàng liên quan ({{
                        shop_relate.length != 0 ? shop_relate.length : 0
                    }})
                </h5>
            </div>
            <div class="section-content m-t-20">
                <div
                    class="list-comment panel"
                    v-if="shop_relate.length != 0"
                ></div>
                <div class="list-comment panel" v-else>
                    Không có cửa hàng liên quan
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
            shop_tags: {},
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
        this.getShopTags();
    },
    methods: {
        url(address) {
            return `http://maps.google.com/?q=${address}`;
        },
        async getShopImages() {
            ShopService.getShopImages(this.shop_id).then(response => {
                this.images = response.data;
                $(document).ready(function() {
                    $(".owl-carousel.1").owlCarousel({
                        margin: 10,
                        lazyLoad: true,
                        dots: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 3
                            },
                            1000: {
                                items: 5
                            }
                        }
                    });
                });
            });
        },
        async getShopComments() {
            ShopService.getShopComments(this.shop_id).then(response => {
                this.comments = response.data;
                $(document).ready(function() {
                    $(".owl-carousel.2").owlCarousel({
                        margin: 10,
                        lazyLoad: true,
                        dots: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 3
                            },
                            1000: {
                                items: 6
                            }
                        }
                    });
                });
            });
        },
        async getShopRelate() {
            ShopService.getShopRelate(this.shop_id).then(response => {
                this.shop_relate = response.data;
            });
        },
        async getShop() {
            this.isLoading = true;
            ShopService.getShop(this.shop_id).then(response => {
                this.isLoading = false;
                this.shop_info = response.data;
            });
        },
        async getShopTags() {
            ShopService.getShopTag(this.shop_id).then(response => {
                this.shop_tags = response.data;
            });
        },
        async getShopListPost() {
            ShopService.getShopListPost(this.shop_id).then(response => {
                this.post_reviews = response.data;
                $(document).ready(function() {
                    $(".owl-carousel.3").owlCarousel({
                        margin: 10,
                        lazyLoad: true,
                        dots: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 3
                            },
                            1000: {
                                items: 6
                            }
                        }
                    });
                });
            });
        }
    }
};
</script>
