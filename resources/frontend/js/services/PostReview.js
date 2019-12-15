export default {
    /**
     * 
     * @param {*} postReviewData 
     */
    async storePostReview(postReviewData) {
        try {
            let response = await axios.post('/api/post-review', postReviewData)
            toastr.success("Tạo bài viết thành công, Bài viết đang đợi admin phê duyệt");
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    /**
     * 
     * @param {*} postReviewData 
     */
    async editPostReview(id, postReviewData) {
        try {
            let response = await axios.post(`/api/post-review/${id}`, postReviewData)
            toastr.success("Chỉnh sửa bài viết thành công");
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async getPostReview(post_review_id) {
        try {
            let response = await axios.get(`/api/post-review/${post_review_id}`)
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async getPostReviewLatestNew(page) {
        try {
            let response = await axios.get(`/api/post-review-latest-new?page=${page}`)
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async getPostReviewHasManyComment() {
        try {
            let response = await axios.get('/api/post-review-has-many-comment')
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async getPostReviewHasManyView() {
        try {
            let response = await axios.get('/api/post-review-has-many-view')
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async deleteImage(id, link) {
        try {
            debugger
            let response = await axios.delete(`/api/post-review/${id}/delete-image?link=${link}`);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async searchText(params) {
        try {
            let response = await axios.get("/api/search", {
                params: params
            });
            return response.data;
        } catch (error) {
            console.log("Error", error.message);
        }
    },

    async searchPostReviews(params) {
        try {
            let response = await axios.get(`/api/search/post_review/filter?rating=${params.stars}&money=${params.money}&city=${params.city_id}&district=${params.district_id}`);
            return response.data;
        } catch (error) {
            console.log("Error", error.message);
        }
    },

    async deletePostReview(id) {
        try {
            let response = await axios.post(`/api/post-review/${id}/request-delete`);
            return response.data;
        } catch (error) {
            console.log("Error", error.message);
        }
    },


}
