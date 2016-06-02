import ls from './services/ls'
import Home from './components/Home.vue'

export function configRouter (router) {
    router.map({
        '/': {
            name: 'home',
            component: Home
        }
    })

    router.redirect({
        '*': '/'
    })

    router.beforeEach(function(transition){
        let token = ls.get('token')

        if( transition.to.auth ){
            if( ! token || token === null ){
                transition.redirect('/login')
            }
        }

        if( transition.to.guest ) {
            if( token ){
                transition.redirect('/')
            }
        }

        transition.next()
    })
}