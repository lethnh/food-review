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
            return response;
        } catch (error) {
            toastr.error(error.response.data.errors[Object.keys(error.response.data.errors)[0]])
        }
    },

    /**
     * 
     * @param {*} registerData 
     */
    async register(registerData) {
        try {
            let response = await axios.post('/api/auth/register', registerData)
            toastr.success('Đăng ký thành công, vui lòng check mail của bạn để biết thêm thông tin');
            return response;
        } catch (error) {
            if (error.response.data.errors.email) {
                toastr.error(error.response.data.errors.email);
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
    async forgotPassword(params) {
        try {
            let response = await axios.post('/api/auth/forgotpassword', {
                email: params
            })
            toastr.success('Vui lòng kiểm tra email để đặt lại mật khẩu');
            return response.data;
        } catch (error) {
            toastr.error(error.response.data.message);
        }
    },

    async resetPassword(data) {
        try {
            let response = await axios.post('/api/auth/change-password', {
                password: data.password,
                password_confirmation: data.password_confirmation,
                token: data.token
            })
            toastr.success('Thay đổi mật khẩu thành công');
            return response.data;
        } catch (error) {
            toastr.error('Error');
        }
    },

    /**
     * 
     * @param {*} forgotData 
     */
    async checkLogin() {
        let response = await axios.get('/api/auth/check')
        return !!response.data.authenticated
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

    async getMyPostReview(page) {
        try {
            let response = await axios.get(`/api/auth/post-review?page=${page}`)
            return response.data;
        } catch (error) {
            toastr.error('Error');
        }
    },

    async getMyComment(page) {
        try {
            let response = await axios.get(`/api/auth/comment?page=${page}`)
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
            toastr.success('Cập nhập thành công');
            return response.data;
        } catch (error) {
            toastr.error('Error');
        }
    }

}
