import auth from './services/auth'
import Home from './components/Home.vue'
import Register from './components/auth/Register.vue'
import Login from './components/auth/Login.vue'

export function configRouter (router) {
    router.map({
        '/': {
            name: 'home',
            component: Home
        },
        'register': {
            name: 'register',
            component: Register,
            guest: true
        },
        'login': {
            name: 'login',
            component: Login,
            guest: true
        }
    })

    router.redirect({
        '*': '/'
    })

    router.beforeEach(function(transition){
        auth.checkAuth()
            .then(() => {
                if ( transition.to.guest ) {
                    transition.redirect('/')
                }
            })
            .catch(() => {
                if ( transition.to.auth ) {
                    transition.redirect('login')
                }
            })

        transition.next()
    })
}