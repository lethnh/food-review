import Ls from './Ls'

export default {


    async getLisShops() {
        try {
            let response = await axios.get('/api/admin/shop')
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
    }
}
