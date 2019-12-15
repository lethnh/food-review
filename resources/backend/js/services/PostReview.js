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

    async getPostReviewRequestDelete(params) {
        try {
            let response = await axios.get('/api/admin/post-review/list-delete', {
                params: params
            })
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async getPostReviewRequestApprove(params) {
        try {
            let response = await axios.get('/api/admin/post-review/list-waiting', {
                params: params
            })
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async getPostReviewBlock(params) {
        try {
            let response = await axios.get('/api/admin/post-review/list-block', {
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
            toastr.error('error')
        }
    },

    async delete(id) {
        try {
            let response = await axios.post(`/api/admin/post-review/${id}/delete`)
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

}
