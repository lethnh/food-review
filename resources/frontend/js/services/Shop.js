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

            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async getShopNew() {
        try {
            let response = await axios.get('/api/shop/new')

            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopImages(id) {
        try {
            let response = await axios.get(`/api/shop/${id}/images`)

            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopComments(id) {
        try {
            let response = await axios.get(`/api/shop/${id}/comments`)

            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopRelate(id) {
        try {
            let response = await axios.get(`/api/shop/${id}/relate`)

            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopListPost(id) {
        try {
            let response = await axios.get(`/api/shop/${id}/list-post`)

            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShop(id) {
        try {
            let response = await axios.get(`/api/shop/${id}`)

            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async getShopTag(id) {
        try {
            let response = await axios.get(`/api/shop/${id}/tags`)
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
    async searchShop(params) {
        try {
            let response = await axios.get(`/api/search/filter?rating=${params.stars}&money=${params.money}&city=${params.city_id}&district=${params.district_id}`)
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    }

}
