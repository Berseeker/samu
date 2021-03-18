import Vue from "vue";
import VueRouter from "vue-router";

import Login from "../Pages/Autenticacion/Login";
import Registro from "../Pages/Autenticacion/Registro";

import ControlPanel from "../Pages/Panel/Index";

import Condiciones from "../Pages/Otros/Condiciones.vue"


Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        redirect: "/login"
    },
    {
        path: "/login",
        name: "Login",
        component: Login
    },
    {
        path: "/registro",
        name: "Registro",
        component: Registro
    },
    {
        path: "/registro-proceso",
        name: "RegistroProceso",
        component: () =>
            import(
                /* webpackChunkName: "main/registro-proceso" */ "../Pages/Autenticacion/RegistroProceso.vue"
            )
    },
    {
        path: "/recuperar-password",
        name: "RecuperarPassword",
        component: () =>
            import(
                /* webpackChunkName: "js/main/recuperar-password" */ "../Pages/Autenticacion/RecuperarPassword.vue"
            )
        // component: RecuperarPassword
    },
    {
        path: "/control-panel",
        name: "ControlPanel",
        component: ControlPanel
        // component: () => import(
        //     /* webpackChunkName: "js/main/control-panel" */ "../Pages/Panel/Index"
        //     )
    },
    {
        path: "/condiciones-de-uso",
        name: "Condiciones",
        component: Condiciones

    },
    {
        path: "/aviso-de-privacidad",
        name: "Aviso",
        component: () =>
            import(
                /* webpackChunkName: "js/main/aviso-de-privacidad" */ "../Pages/Otros/AvisoPrivacidad.vue"
            )
    },
    {
        path: "/ayuda",
        name: "Ayuda",
        component: () =>
            import(
                /* webpackChunkName: "js/main/ayuda" */ "../Pages/Otros/Ayuda.vue"
            )
    },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

export default router;
