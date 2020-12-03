require('./bootstrap');

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import MainComponent from './Main.vue'
import RegisterComponent from './components/Auth/Register'


const routes = [
    { path: '/', component: MainComponent },
    {path : '/register', component: RegisterComponent}
]

const router = new VueRouter({
    routes: routes 
})


const app = new Vue({
    el: '#app',
    router
})