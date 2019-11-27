import Ls from './Ls'

export default {


    async getLisShops() {
        try {
            let response = await axios.get('/api/shops')
            console.log(response.data.data);
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    /**
     * 
     * @param {*}  
     */
    async getShops() {
        try {
            let response = await axios.get('/api/shops')
            console.log(response.data.data);
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopHasManyPostReview() {
        try {
            let response = await axios.get('/api/shop/post-review')
            console.log(response.data);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async getShopNew() {
        try {
            let response = await axios.get('/api/shop/new')
            console.log(response.data);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopImages(id) {
        try {
            let response = await axios.get(`/api/shop/${id}/images`)
            console.log(response.data);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopComments(id) {
        try {
            let response = await axios.get(`/api/shop/${id}/comments`)
            console.log(response.data);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopRelate(id) {
        try {
            let response = await axios.get(`/api/shop/${id}/relate`)
            console.log(response.data);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopListPost(id) {
        try {
            let response = await axios.get(`/api/shop/${id}/list-post`)
            console.log(response.data);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShop(id) {
        try {
            let response = await axios.get(`/api/shop/${id}`)
            console.log(response.data);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    }

}
