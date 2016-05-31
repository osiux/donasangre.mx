import Vue from 'vue'
import VueResource from 'vue-resource'
import router from './router'
import App from './components/app.vue'

Vue.use(VueResource)

router.start(App, 'body')