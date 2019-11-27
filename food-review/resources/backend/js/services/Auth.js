import Ls from './Ls'

export default {

    /**
     * 
     * @param {*} loginData 
     */
    async login(loginData) {
        try {
            let response = await axios.post('/api/auth/login', loginData)
            toastr.success("Đăng nhập thành công");
            // Ls.set('access_token', response.data.access_token);
            // Ls.set('expires_at', response.data.expires_at);
            // Ls.set('token_type', response.data.token_type);
            return response;
        } catch (error) {
            console.log(error);
            toastr.error('error')
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
        let authUser = JSON.parse(Ls.get('authUser'));
        
        return authUser;
    },

    async createUser(data) {
        try {
            let response = await axios.post("/api/admin/user/create", data);
            toastr.success("Tạo thành công");
            return response.data;
        } catch (error) {
            toastr.error("Tạo thất bại");
        }
    },

}
