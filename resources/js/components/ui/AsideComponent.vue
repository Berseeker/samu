<template>
  <aside class="w-1/5">
    <div class="bg-cyan">
      <router-link to="/control-panel" class="mx-auto">
        <img
          src="/assets/brand/logo.png"
          class="logo mx-auto"
          alt="Logo Samu"
        />
      </router-link>
    </div>
    <div>
      <span class="block px-6 texto-cairo-light mt-5">
        Gestión de la Tienda
      </span>
      <nav class="flex flex-col w-full">
        <router-link
          to="/control-panel/panel"
          class="block texto-cairo-semi-bold cursor-pointer nav-item py-2 px-6"
          active-class="active-item"
          >Panel de Control</router-link
        >

        <router-link
          to="/control-panel/ordenes"
          active-class="active-item"
          class="block texto-cairo-semi-bold cursor-pointer nav-item py-2 px-6"
          >Ordenes</router-link
        >

        <router-link
          to="/control-panel/productos"
          active-class="active-item"
          class="block texto-cairo-semi-bold cursor-pointer nav-item py-2 px-6"
          >Productos</router-link
        >

        <router-link
          to="/control-panel/informes"
          active-class="active-item"
          class="block texto-cairo-semi-bold cursor-pointer nav-item py-2 px-6"
          >Informes</router-link
        >
      </nav>
    </div>
    <div>
      <span class="block px-6 texto-cairo-light mt-5">Configuración</span>
      <nav class="flex flex-col w-full">
        <a
          @click="activarConfiguracion"
          class="block text-left texto-cairo-semi-bold cursor-pointer nav-item py-2 px-6"
          :class="{ 'active-dropdown': isActive }"
        >
          Configuración
        </a>
      </nav>
    </div>
    <div class="fixed bottom-0 w-1/5 flex justify-center">
      <button
        @click="logout()"
        class="mx-auto bg-white p-3 mb-20 font-bold texto-hover-amarillo text-xl focus:outline-none"
      >
        Cerrar sesión
      </button>
    </div>
  </aside>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
  name: "AsideComponent",
  data() {
    return {
      isActive: false,
    };
  },
  computed: {
    ...mapState(["usuario", "token", "url"]),
  },
  methods: {
    ...mapMutations(["SET_AUTH"]),
    logout() {
      axios
        .post(
          `${this.url}logout`,
          {},
          {
            headers: {
              Authorization: this.token,
            },
          }
        )
        .then((res) => {
          if (res.data.code === 200) {
            this.SET_AUTH(false);
            localStorage.clear();
            this.$router.push("/login");
          }
        });
    },
    activarConfiguracion() {
      this.isActive = !this.isActive;
    },
  },
};
</script>

