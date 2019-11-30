export default {
    /**
     * 
     * @param {*} postReviewData 
     */
    async getPostReviews(params) {
        try {
            let response = await axios.get('/api/admin/post-review', {
                params: params
            })
      
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async getPostReview(id) {
        try {
            let response = await axios.get(`/api/admin/post/${id}`)
      
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async approve(id, params) {
        try {
            let response = await axios.post(`/api/admin/post-review/${id}/approve`, {
                status: params
            })
      
            return response.data;
        } catch (error) {
            console.log(error);

        }
    },

}
