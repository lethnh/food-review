import Ls from './Ls'

export default {

    async getCities() {
        try {
            let response = await axios.get('/api/cities/')
            return response.data;
        } catch (error) {
            console.log(error);
            toastr.error('error')
        }
    },
}
