import Vue from 'vue'
import Nprogress from 'nprogress'
import ls from './services/ls'
import Unauthorized from './unauthorized'

export default function(request, next) {
    let token = ls.get('token')

    if ( token !== null || token !== 'undefined' ) {
        Vue.http.headers.common.Authorization = `Bearer ${token}`;
    }

    next((response) => {
        Nprogress.done()

        if( response.json().message === 'Token has expired' ){
            return Unauthorized.handle(request)
        }

        if ( response.headers && response.headers.Authorization ) {
            ls.set('token', response.headers.Authorization);
        }

        if ( response.json() && response.json().token && response.json().token.length > 10 ) {
            ls.set('token', response.data.token);
        }
    })
}