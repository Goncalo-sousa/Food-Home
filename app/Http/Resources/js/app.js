const { default: Axios } = require('axios')

require('./bootstrap')

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import AppComponent from './App.vue'
import UsersComponent from './components/users.vue'
import ProductsComponent from './components/products.vue'
import EditUserComponent from './components/edit_user.vue'

Vue.component('users',UsersComponent);

const routes =[
    {path: '/', redirect:'/users'},
    {path: '/users', component:AppComponent},
    {path: '/users/:id', component:EditUserComponent},
    {path: '/products', component:ProductsComponent},

]

const router = new VueRouter({
    routes: routes //routes
})

const app = new Vue({
    el: '#app',
    router //=router:router
})
