import Vue from 'vue'
import NProgress from 'nprogress'

export default {
    getProfile() {
        return Vue.http.get('me')
    },
    updateProfile(data) {
        NProgress.start()
        
        return Vue.http.put('me', data)
    }
}