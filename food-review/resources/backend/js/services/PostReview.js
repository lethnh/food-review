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
            console.log(response);
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async approve(id, status) {
        try {
            let response = await axios.post(`/api/admin/post-review/${id}/approve`, status)
            console.log(response);
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

}
