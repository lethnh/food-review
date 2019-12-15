import Ls from './Ls'

export default {

    /**
     * 
     * @param {*} loginData 
     */
    async login(loginData) {
        try {
            let response = await axios.post('/api/admin/auth/login', loginData)
            toastr.success("Đăng nhập thành công");
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },

    /**
     * 
     */
    async logout() {
        try {
            let response = await axios.post('/api/auth/logout')
            return response;
        } catch (error) {
            toastr.error('Error')
        }
    },

    /**
     * 
     * @param {*} params 
     */
    async getUsers(params) {
        try {
            let response = await axios.get("/api/admin/user", {
                params: params
            });
            return response.data;
        } catch (error) {
            console.log("Error", error.message);
        }
    },
    /**
     * 
     * @param {*} forgotData 
     */
    async checkLogin() {
        try {
            let response = await axios.get('/api/admin/auth/check')
            return !!response.data.authenticated
        } catch (error) {
            return false;
        }
    },

    async createUser(data) {
        try {
            let response = await axios.post("/api/admin/user/create", data);
            toastr.success("Tạo thành công");
            return response.data;
        } catch (error) {
            toastr.error(error.response.data.message);
        }
    },

    async getInfo() {
        try {
            let response = await axios.get("/api/admin/info");
            return response.data;
        } catch (error) {

        }
    },

    async blockUser(id) {
        try {
            let response = await axios.post(`/api/admin/user/block/${id}`)
            return response;
        } catch (error) {
            toastr.error('Error')
        }
    },

    async unBlockUser(id) {
        try {
            let response = await axios.post(`/api/admin/user/unBlock/${id}`)
            return response;
        } catch (error) {
            toastr.error('Error')
        }
    },

}
