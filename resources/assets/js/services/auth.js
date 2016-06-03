import Vue from 'vue'
import NProgress from 'nprogress'
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
    logout() {
        return new Promise((resolve, reject) => {
            try {
                ls.remove('token')
                this.user.authenticated = false
                resolve()
            }catch(e) {
                reject(e)
            }
        })
    },
    getToken() {
        return new Promise((resolve, reject) => {
            const token = ls.get('token')

            if ( token ) {
                resolve(token)
            }else{
                reject()
            }
        })
    },
    authUser(token) {
        this.user.authenticated = true
        ls.set('token', token)
    },
    resetAuth() {
        ls.remove('token')
        this.user.authenticated = false
        throw err
    },
    checkAuth() {
        return this.getToken()
            .then(this.authUser.bind(this))
            .catch(this.resetAuth.bind(this))
    }
}