<template>
  <div class="flex">
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
        <span class="block px-6 font-light mt-5"> Gestión de la Tienda </span>
        <nav class="flex flex-col w-full">
          <router-link
            to="/control-panel/panel"
            class="block font-semibold cursor-pointer nav-item py-2 px-6"
            active-class="active-item"
            >Panel de Control</router-link
          >

          <router-link
            to="/control-panel/ordenes"
            active-class="active-item"
            class="block font-semibold cursor-pointer nav-item py-2 px-6"
            >Ordenes</router-link
          >

          <router-link
            to="/control-panel/productos"
            active-class="active-item"
            class="block font-semibold cursor-pointer nav-item py-2 px-6"
            >Productos</router-link
          >

          <router-link
            to="/control-panel/informes"
            active-class="active-item"
            class="block font-semibold cursor-pointer nav-item py-2 px-6"
            >Informes</router-link
          >
        </nav>
      </div>
      <div>
        <span class="block px-6 font-light mt-5">Configuración</span>
        <nav class="flex flex-col w-full">
          <button
            @click="activarConfiguracion"
            class="block text-left font-semibold cursor-pointer nav-item py-2 px-6 focus:outline-none"
            :class="{ 'active-dropdown': isActive }"
          >
            Configuración
          </button>
        </nav>
      </div>
      <div class="fixed bottom-0 w-1/5 flex justify-center">
        <button
          @click="logout()"
          class="mx-auto bg-white p-3 mb-20 font-bold hover:text-purple-800 focus:outline-none"
        >
          Cerrar sesión
        </button>
      </div>
    </aside>
    <main class="flex-1 overflow-auto bg-gray-300 h-screen">
      <router-view :key="$route.path"></router-view>
    </main>
  </div>
</template>

<script>
import { mapState, mapMutations } from "vuex";
export default {
  name: "PanelIndex",
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

<style scoped>
.active-item {
  color: white;
  background-color: #06b0d7;
}
.active-dropdown {
  color: white;
  background-color: rgba(156, 163, 175, 1);
}
.nav-item:hover {
  color: white;
  background-color: #06b0d7;
}
</style>
