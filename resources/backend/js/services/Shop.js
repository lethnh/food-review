import Ls from './Ls'

export default {


    async getLisShops(params) {
        try {
            let response = await axios.get('/api/admin/shop',{
                params: params
            })
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

    async createShop(data) {
        try {
            let response = await axios.post('/api/admin/shop/create', data)
            console.log(response.data);
            toastr.success('Tạo thành công')
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    async deleteShop(id) {
        try {
            let response = await axios.post(`/api/admin/shop/${id}/delete`)
            console.log(response.data);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    }

}
