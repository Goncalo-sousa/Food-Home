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
import store from './store'
import VueCookies from 'vue-cookies'
import axios from 'axios'
import OrderComponent from './components/Orders/orders.vue'
import CookDashboard from './components/Dashboard/CookDashboard.vue'
import DeliverymanDashboard from './components/Dashboard/deliverymanDashboard.vue'
import MyOrders from './components/Dashboard/myOrders.vue'
import OrderItemComponent from './components/Orders/order_item.vue'
import MyProfileComponent from './components/user/myprofile.vue'
import CartComponet from './components/Cart/carrinho.vue'

Vue.use(VueCookies)
Vue.component('manage-users', ManageUsersComponent);
Vue.component('products', ProductsComponent);
Vue.component('edit-products', EditProductComponent);
Vue.component('orders', OrderComponent);
Vue.component('cookDashboard', CookDashboard)
Vue.component('deliverymanDashboard', DeliverymanDashboard)
Vue.component('myOrders', MyOrders)


const routes = [
    { path: '/', component: MainComponent },
    { path: '/register', name: 'Register', component: RegisterComponent },
    { path: '/login', name: 'Login', component: LoginComponent },
    { path: '/management', name: 'Management', component: ManagementComponent },
    { path: '/users/:id', component: EditUserComponent },
    { path: '/products/:id', component: EditProductComponent },
    { path: '/products', name: 'Products', component: ProductsComponent },
    { path: '/orders', name: 'Orders', component: OrderComponent },
    { path: '/cookdashboard', name: 'CookDashboard', component: CookDashboard },
    { path: '/myorders', name: 'MyOrders', component: MyOrders },
    { path: '/deliverymanDashboard', name: 'deliverymanDashboard', component: DeliverymanDashboard },
    { path: '/orderitems', name: 'OrderItems', component: OrderItemComponent },
    { path: '/myprofile', name: 'MyProfile', component: MyProfileComponent },
    { path: '/cart', name: 'Cart', component: CartComponet },
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

router.beforeEach((to, from, next) => {
    if (to.name == 'Management' && store.state.user.type != 'EM') next({ path: '/' })
    else next()
})