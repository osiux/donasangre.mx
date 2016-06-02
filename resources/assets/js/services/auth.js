import Vue from 'vue'
import NProgress from 'nprogress';
import ls from './ls'

export default {
    user: {
        authenticated: false,
    },
    login(credentials) {
        NProgress.start()

        return Vue.http.post('login', credentials)
            .then((response) => {
                this.authUser(response.data.token)

                return response
            })
    },
    register(data) {
        NProgress.start()

        return Vue.http.post('register', data)
            .then((response) => {
                this.authUser(response.data.token)

                return response
            })
    },
    authUser(token) {
        this.user.authenticated = true
        ls.set('token', token)
    }
}