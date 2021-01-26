require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import VueMask from 'v-mask'

Vue.use(VueRouter)
Vue.use(BootstrapVue)
Vue.use(VueMask)

import MainPage from './views/MainPage.vue'
import CreatePet from './views/CreatePet.vue'

import App from './views/app.vue'

const routes = [
    { path: '/', component: MainPage },
    { path: '/create', component: CreatePet },
]

const router = new VueRouter({
    routes: routes,
    mode: 'history'
  })
  

const app = new Vue({
    el: '#app',
    router,
    components: { App }
});
