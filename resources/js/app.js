require('./bootstrap');

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import MainComponent from './Main.vue'


const routes = [
    { path: '/', component: MainComponent },
]

const router = new VueRouter({
    routes: routes 
})

const app = new Vue({
    el: '#app',
    router
})