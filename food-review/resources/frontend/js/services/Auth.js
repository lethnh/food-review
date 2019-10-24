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
            toastr.success('Đăng ký thành công');
            console.log(response.error);
            return response;
        } catch (error) {
            debugger
            console.log(error.response);
            if (error.response.data.error.email) {
                toastr.error(error.response.data.error.email);
            }
            return error;
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


    /**
     * 
     * @param {*} forgotData 
     */
    async getUser() {
        try {
            let response = await axios.get('/api/auth/user')
            return response.data;
        } catch (error) {
            toastr.error('Error');
        }
    },

    async getMyPostReview() {
        try {
            let response = await axios.get('/api/auth/post-review')
            return response.data;
        } catch (error) {
            toastr.error('Error');
        }
    },

    async getMyComment() {
        try {
            let response = await axios.get('/api/auth/comment')
            return response.data;
        } catch (error) {
            toastr.error('Error');
        }
    },

    async uploadAvatar(data) {
        try {
            let response = await axios.post('/api/auth/avatar', data)
            return response.data;
        } catch (error) {
            toastr.error('Error');
        }
    },

    async editUser(data) {
        try {
            let response = await axios.post('/api/auth/edit', data)
            return response.data;
        } catch (error) {
            toastr.error('Error');
        }
    }

}
