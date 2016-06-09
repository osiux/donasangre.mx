import Vue from 'vue'
import Nprogress from 'nprogress'
import ls from './services/ls'
import Unauthorized from './unauthorized'

export default function() {
    return {
        request(request) {
            let token = ls.get('token')

            if ( token !== null || token !== 'undefined' ) {
                Vue.http.headers.common.Authorization = `Bearer ${token}`;
            }

            return request
        },
        response(response) {
            Nprogress.done()

            if( response.data.message === 'Token has expired' ){
                return Unauthorized.handle(response)
            }

            if ( response.headers && response.headers.Authorization ) {
                ls.set('token', response.headers.Authorization);
            }

            if ( response.data && response.data.token && response.data.token.length > 10 ) {
                ls.set('token', response.data.token);
            }

            return response
        }
    }
}