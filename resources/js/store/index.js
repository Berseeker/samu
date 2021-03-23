import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        url: "http://samu.test/api/",
        auth: false,
        usuario: {},
        token: "",
        formulario_registro: {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            tienda_nombre: "",
            categoria_id: "",
            divisa: ""
        },
        cat_categorias:[]
    },
    mutations: {
        SET_USUARIO(state, payload) {
            state.usuario = payload;
        },
        SET_TOKEN(state, payload) {
            state.token = payload;
            localStorage.setItem("access_token", state.token);
        },
        SET_AUTH(state, payload) {
            state.auth = payload;
        }
    },
    actions: {},
    getters: {}
});
