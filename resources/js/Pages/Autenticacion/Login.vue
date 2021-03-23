<template>
  <AuthLayout>
    <section class="hero">
      <div class="hero-img"></div>
      <div class="container px-5 mx-auto mt-10 md:mt-0 lg:pt-20 flex sm:mb-40">
        <div
          class="xl:w-1/3 lg:w-1/2 md:w-1/2 md:ml-auto lg:ml-auto w-full md:mt-0 relative z-10 animate__animated animate__fadeInRight"
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
              Acceder a su cuenta
            </h2>
            <div v-if="loading" class="flex mx-auto py-5">
              <spin-component />
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
              <div class="mb-4">
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
              </div>

              <alert-component v-if="error" :msg="msgError" />

              <div class="my-4">
                <router-link
                  to="/recuperar-password"
                  class="text-blue-500 bg-white font-bold border-0 py-4 focus:outline-none hover:text-purple-800"
                  >¿Olvidaste tu contraseña?</router-link
                >
              </div>
              <div class="container__auth-botones">
                <button
                  class="w-auto mb-4 md:mb-0 uppercase text-white bg-black font-bold border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 text-lg"
                  @click="validar"
                >
                  Ingresar
                </button>
                <router-link
                  to="/registro"
                  class="uppercase text-center text-blue-500 bg-white font-bold border-0 py-2 px-6 focus:outline-none hover:text-purple-800"
                >
                  CREAR UNA NUEVA CUENTA
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </AuthLayout>
</template>

<script>
import { mapState, mapMutations } from "vuex";
import AuthLayout from "@/Layouts/AuthLayout";
import AlertComponent from "../../components/AlertComponent.vue";
import SpinComponent from "../../components/SpinComponent.vue";

export default {
  name: "LoginScreen",
  components: {
    AuthLayout,
    AlertComponent,
    SpinComponent,
  },
  data() {
    return {
      error: false,
      msgError: "",
      loading: false,
      formulario_login: {
        email: null,
        password: null,
      },
    };
  },
  computed: {
    ...mapState(["url"]),
  },
  methods: {
    ...mapMutations(["SET_USUARIO", "SET_TOKEN", "SET_AUTH"]),
    login() {
      this.loading = true;
      axios
        .post(`${this.url}login`, { ...this.formulario_login })
        .then((response) => {
          if (response.data.code === 200) {
            this.SET_USUARIO(response.data.data[0]);
            this.SET_TOKEN(`Bearer ${response.data.token}`);
            this.SET_AUTH(true);
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
        this.formulario_login.password === null ||
        this.formulario_login.email === "" ||
        this.formulario_login.password === ""
      ) {
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
@media (min-width: 768px) {
  .container__auth-botones {
    grid-template-columns: 40% 60%;
    align-items: center;
  }
}

.hero {
  position: relative;
  height: calc(100vh + 40vh);
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
  background-image: url("/assets/brand/Bg_1_Movil.jpg");
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
    /*padding-top: 100px;*/
    /*margin-bottom: 70px;*/
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top center;
    background-image: url("/assets/brand/Bg_1.jpg");
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
