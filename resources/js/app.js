require('./bootstrap');

window.Vue = require('vue')

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import MainComponent from './Main.vue'
import LoginComponent from './components/Auth/Login'
import RegisterComponent from './components/Auth/Register.vue'
import ProductsComponent from './components/products/products.vue'
import EditProductComponent from './components/products/edit_product.vue'
import ManageUsersComponent from './components/Admin/manageUsers.vue'
import EditUserComponent from './components/Admin/edit_user.vue'
import ManagementComponent from './components/Admin/management.vue'
import store from './store';
import VueCookies from 'vue-cookies'
import axios from 'axios';



Vue.use(VueCookies)
Vue.component('manage-users', ManageUsersComponent);
Vue.component('products', ProductsComponent);

const routes = [
    { path: '/', component: MainComponent },
    { path: '/register', name: 'Register', component: RegisterComponent },
    { path: '/login', name: 'Login', component: LoginComponent },
    { path: '/management', name: 'Management', component: ManagementComponent, meta: { requiresAuth: true } },
    { path: '/users/:id', component: EditUserComponent },
    { path: '/products/:id', component: EditProductComponent },
    { path: '/products', name: 'Products', component: ProductsComponent },
]


const router = new VueRouter({
    routes: routes //routes
})

const app = new Vue({
    el: '#app',
    store,
    router,
    methods: {
        LogOut: function () {
            this.$store.dispatch('LogOut');
            this.$router.push('/login');
        }
    },
    mounted: function () {
        let token = Vue.$cookies.get('XSRF-TOKEN')
        if (token) {
            axios.get('/api/user', { headers: { ['X-XSRF-TOKEN']: token } }).then(response => {
                this.$store.dispatch('LogIn', response.data)
            }).catch(error => {
                console.log(error)
            })
        }
    }
})

router.beforeEach((to, from, next) => {
    if (to.name == 'Management' && !store.getters.isAuthenticated) next({ name: 'Login' })
    else next()
})