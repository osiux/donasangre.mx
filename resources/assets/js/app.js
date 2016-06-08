import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import { configRouter } from './router'
import Interceptor from './interceptor'
import App from './App.vue';

Vue.use(VueResource)
Vue.use(VueRouter)
Vue.http.options.root = window.APIURL;
Vue.http.interceptors.push(Interceptor)

const router = new VueRouter({
    history: true,
    saveScrollPosition: false,
    linkActiveClass: 'active'
})

configRouter(router)

router.start(App,'#app')