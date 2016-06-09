// https://github.com/mrgodhani/laterpost/blob/c7a3282ba09e729dda809107a286b6d24ad246a4/resources/assets/js/unauthorized.js

import Vue from 'vue'
import ls from './services/ls'

export default {
    handle(response){
        var self = this;
        var retry = function(respdata) {
            ls.set('token', respdata.data.token)
            return self.retry(response.request).then(function(respond){
                return respond
            });
        }.bind(this);

        return Vue.http.get('refresh')
            .then(retry)
    },
    retry(request){
        var method = request.method.toLowerCase()
        return Vue.http[method](request.url, request.params)
    }

}