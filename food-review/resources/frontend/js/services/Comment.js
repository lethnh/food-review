import Ls from './Ls'

export default {

    async getComment(id) {
        try {
            let response = await axios.get(`/api/comment/${id}`)
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async commetPostReview(commentData) {
        try {
            let response = await axios.post('/api/comment', commentData)
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
}
