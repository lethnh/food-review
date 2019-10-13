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
     * @param {*} registerData 
     */
    async register(registerData) {
        try {
            let response = await axios.post('/api/auth/register', registerData)

            toastr.error('Are you the 6 fingered man?')
            return response.data
        } catch (error) {}
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
     * @param {*} forgotData 
     */
    async forgotPassword(forgotData) {
        try {
            let response = await axios.post('/api/auth/forgotpassword', forgotData)
            return response.data;
        } catch (error) {
            toastr.error('Error');
        }
    },

}
