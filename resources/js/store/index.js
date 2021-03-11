import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        url: 'http://samu.test/api/',
        usuario: {},
        token: ''
    },
    mutations: {
        SET_USUARIO(state, payload) {
            state.usuario = payload;
        },
        SET_TOKEN(state, payload) {
            state.token = `Bearer ${payload}`;
        }
    },
    actions: {
    },
    getters: {}
});
