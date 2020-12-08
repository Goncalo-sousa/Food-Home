require('./bootstrap');

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import MainComponent from './Main.vue'
import LoginComponent from './components/Auth/Login'
import RegisterComponent from './components/Auth/Register.vue'
import ProductsComponent from './components/products.vue'
import EditProductComponent from './components/edit_product.vue'
import ManageUsersComponent from './components/Admin/manageUsers.vue'
import EditUserComponent from './components/Admin/edit_user.vue'
import ManagementComponent from './components/Admin/management.vue'

Vue.component('manage-users', ManageUsersComponent);
Vue.component('products', ProductsComponent);

const routes = [
    { path: '/', component: MainComponent },
    { path: '/register', component: RegisterComponent },
    { path: '/login', component: LoginComponent},
    { path: '/management', component: ManagementComponent },
    { path: '/users/:id', component: EditUserComponent },
    { path: '/products/:id', component: EditProductComponent },
    { path: '/products', component: ProductsComponent },
]


const router = new VueRouter({
    routes: routes //routes
})

const app = new Vue({
    el: '#app',
    router //=router:router
})
