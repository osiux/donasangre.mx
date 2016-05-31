import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
    history: true,
    linkActiveClass: 'active'
})

export default {
    router
}