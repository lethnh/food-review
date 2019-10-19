export default {
    /**
     * 
     * @param {*} postReviewData 
     */
    async storePostReview(postReviewData) {
        try {
            let response = await axios.post('/api/post-review', postReviewData)
            toastr.success("Tạo bài viết thành công");
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
    }
}
