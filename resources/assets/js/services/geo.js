import Vue from 'vue'
import NProgress from 'nprogress'


export default {
    searchByPostalCode(code) {
        NProgress.start()

        return Vue.http.get('geo/postalcodes/' + code)
            .then((response) => {
                return response.data.data
            })
    },
    getStates() {
        return Vue.http.get('geo/states')
            .then((response) => {
                return response.data
            })
    }
}