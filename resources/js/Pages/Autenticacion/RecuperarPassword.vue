<template>
    <AuthLayout>
        <section class="hero ">
            <div class="hero-img"></div>
            <div class="container px-5 mx-auto mt-10 md:mt-0 lg:pt-20 flex sm:mb-40 justify-center">
                <div
                    class="w-1/2 animate__animated animate__fadeInUp"
                >
                    <h1 class="uppercase text-black text-5xl my-5 font-extrabold">
                        venda online con samu.app
                    </h1>
                    <p class="uppercase text-black text-xl">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad
                        assumenda
                    </p>
                    <div class="bg-white p-5 flex flex-col shadow-md mt-10">
                        <h2 class="text-black text-lg font-xl uppercase font-extrabold">
                            Recuperar Contraseña
                        </h2>
                        <div v-if="loading" class="flex mx-auto py-5">
                            <spin-component/>
                        </div>
                        <div v-else>
                            <div class="my-4">
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="E-mail"
                                    v-model="formulario_login.email"
                                    autocomplete="off"
                                    class="w-full bg-gray-300 border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                    :class="{
                    'border-red-500': error,
                    'border-4': error,
                  }"
                                />
                            </div>
                            <!-- <div class="mb-4">
                              <input
                                autocomplete="off"
                                v-model="formulario_login.password"
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Contraseña"
                                class="w-full bg-gray-300 border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outlinenone text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                :class="{
                                  'border-red-500': error,
                                  'border-4': error,
                                }"
                              />
                            </div> -->

                            <alert-component v-if="error" :msg="msgError"/>

                            <div class="container__auth-botones mb-5">
                                <button
                                    class="w-auto uppercase text-white bg-black font-bold border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 text-lg"
                                    @click="validar"
                                >
                                    Recuperar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AuthLayout>
</template>

<script>
import {mapState, mapMutations} from "vuex";
import AuthLayout from "@/Layouts/AuthLayout";
import AlertComponent from "../../components/AlertComponent.vue";
import SpinComponent from "../../components/SpinComponent.vue";

export default {
    name: "RecuperarContraseñaScreen",
    components: {
        AuthLayout,
        AlertComponent,
        SpinComponent,
    },
    data() {
        return {
            ruta: "http://samu.test/api/",
            error: false,
            msgError: "",
            loading: false,
            formulario_login: {
                email: null,
                // password: null,
            },
        };
    },
    computed: {
        ...mapState(["usuario", "token", "url"]),
    },
    methods: {
        ...mapMutations(["SET_USUARIO", "SET_TOKEN"]),
        login() {
            this.loading = true;
            axios
                .post(`${this.url}login`, {...this.formulario_login})
                .then((response) => {
                    if (response.data.code === 200) {
                        this.SET_USUARIO(response.data.data[0]);
                        this.SET_TOKEN(response.data.token);
                        this.$router.push("/control-panel");
                    }
                })
                .catch((e) => {
                    this.loading = false;
                    this.error = true;
                    this.msgError = e.response.data.message;
                });
        },
        validar() {
            if (
                this.formulario_login.email === null ||
                this.formulario_login.email === ""
            ) {
                // this.formulario_login.password === null ||
                // this.formulario_login.password === ""
                this.loading = false;
                this.error = true;
                this.msgError = "Complete los campos porfavor";
            } else {
                this.error = false;
                this.msgError = "";
                this.login();
            }
        },
    },
};
</script>

<style scoped>
.container__auth-botones {
    display: grid;
    grid-template-columns: 1fr;
    align-items: center;
}

.hero {
    position: relative;
    height: calc(100vh);
    overflow-x: hidden;
    overflow-y: hidden;
}

@media (min-width: 1280px) {
    .hero {
        position: relative;
        height: calc(100vh - 132px);
        overflow-x: hidden;
        overflow-y: hidden;
    }
}


.hero-img {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top center;
    background-image: url("/assets/brand/02_Fondo_mosaico.jpg");
}

@media (min-width: 768px) {
    .hero {
        position: relative;
        height: calc(100vh);
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .hero-img {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top center;
        background-image: url("/assets/brand/02_Fondo_mosaico.jpg");
    }
}

@media (min-width: 1280px) {
    .hero {
        position: relative;
        height: calc(100vh - 132px);
        overflow-x: hidden;
        overflow-y: hidden;
    }
}
</style>
