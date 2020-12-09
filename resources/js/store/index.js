import Vuex from 'vuex';
import Vue from 'vue';
//import createPersistedState from "vuex-persistedstate";
//import auth from './modules/auth';

// Load Vuex
Vue.use(Vuex);
// Create store
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
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user
        },
    },
    actions: {
        async LogIn({ commit }, user) {
            await commit('setUser', user)
        },
        async LogOut({ commit }) {
            await commit('setUser', null)
        },
    }
});