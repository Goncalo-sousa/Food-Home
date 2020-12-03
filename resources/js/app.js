require('./bootstrap');

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import MainComponent from './Main.vue'
import RegisterComponent from './components/Auth/Register'
import ProductsComponent from './components/products.vue'
import EditUserComponent from './components/edit_product.vue'


const routes = [
    // {path: '/', redirect:'/users'},
    { path: '/', component: MainComponent },
    //{path : '/register', component: RegisterComponent},
   // {path: '/users', component:AppComponent},
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
