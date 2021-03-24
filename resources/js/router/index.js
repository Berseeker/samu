import Vue from "vue";
import VueRouter from "vue-router";

import store from "../store/index";

import Login from "../Pages/Autenticacion/Login";
import Registro from "../Pages/Autenticacion/Registro";

import ControlPanel from "../Pages/Paneles/Index";

import Condiciones from "../Pages/Otros/Condiciones.vue";

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
        redirect: "/control-panel/panel",
        name: "ControlPanel",
        component: ControlPanel,
        meta: { requiresAuth: true },
        children: [
            {
                path: "panel",
                name: "PanelPage",
                meta: { requiresAuth: true },
                component: () =>
                    import(
                        /* webpackChunkName: "PanelPage" */ "../Pages/Paneles/Panel.vue"
                    )
            },
            {
                path: "ordenes",
                name: "OrdenesPage",
                meta: { requiresAuth: true },
                component: () =>
                    import(
                        /* webpackChunkName: "OrdenesPage" */ "../Pages/Paneles/Ordenes.vue"
                    )
            },
            {
                path: "productos",
                name: "ProductosPage",
                meta: { requiresAuth: true },
                component: () =>
                    import(
                        /* webpackChunkName: "ProductosPage" */ "../Pages/Paneles/Productos.vue"
                    )
            },
            {
                path: "informes",
                name: "InformesPage",
                meta: { requiresAuth: true },
                component: () =>
                    import(
                        /* webpackChunkName: "InformesPage" */ "../Pages/Paneles/Informes.vue"
                    )
            }
        ]
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
    }
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("access_token");

    if (token != null) {
        store.commit("SET_AUTH", true);
        store.commit("SET_TOKEN", token);
    }

    const auth = store.state.auth;

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!auth) {
            next({ path: "/login" });
        } else {
            next();
        }
    } else if (
        to.name === "Login" ||
        to.name === "Registro" ||
        to.name === "RegistroProceso" ||
        to.name === "RecuperarPassword"
    ) {
        if (auth) {
            next({ path: "/control-panel" });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
