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
    }
}
