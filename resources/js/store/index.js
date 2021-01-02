import Vuex from 'vuex';
import Vue from 'vue';
<<<<<<< HEAD
// import VuexPersistence from "vuex-persistedstate";
=======
//import VuexPersistence from "vuex-persistedstate";
>>>>>>> 8e6874d96c0b5a34ec4368a7a89f30dad4ef6ced
//import auth from './modules/auth';

// Load Vuex
Vue.use(Vuex);
// Create store
// const vuexLocal = new VuexPersistence({
//     storage: window.localStorage,
//   });

export default new Vuex.Store({
    getters: {
        user: function (state) {
            return state.user;
        },
        isAuthenticated: state => !!state.user
    },
    modules: {
    },
    state: {
        user: null,
        cart: [],
        cartCount: 0,
        plugins: [vuexLocal.plugin],
    },
    mutations: {
        setUser(state, user) {
            state.user = user
        },
        addToCart(state, item) {
            let found = state.cart.find(product => product.id == item.id);
            if (found) {
                found.quantity++;
                found.totalPrice = found.quantity * found.price;
            } else {
                state.cart.push(item);
                Vue.set(item, 'quantity', 1);
                Vue.set(item, 'totalPrice', item.price);
            }
            state.cartCount++;
            this.commit('saveCart');
        },
        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);

            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= product.quantity;

                state.cart.splice(index, 1);
            }
            this.commit('saveCart');
        },
        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        },
        clearCart(state) {
            state.cart = [];
            state.cartCount = 0;
        },
        // saveSingleUserConnections: (state, connections) => { state.savedSingleUserConnections = connections; },
    },
    actions: {
        async LogIn({ commit }, user) {
            await commit('setUser', user)
        },
        async LogOut({ commit }) {
            Vue.$cookies.set('XSRF-TOKEN', null)
            await commit('setUser', null)
        },
    }
});