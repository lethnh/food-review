// import Ls from './ls'

export default {

    /**
     * 
     * @param {*} loginData 
     */
    async login(loginData) {
        try {
            let response = await axios.post('/api/auth/login', loginData)
            return response.data
        } catch (error) {
            console.log(error);

            toastr.error('')
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

        } catch (error) {

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
            // toastr['error'](__('Something was wrong. Please try again later!'), 'Error')
            // toastr.error('I do not think that word means what you think it means.', 'Inconceivable!')
        }
    },

}
