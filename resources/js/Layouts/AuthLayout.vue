<template>
  <div class="min-h-screen">
    <header class="bg-cyan">
      <div class="container mx-auto py-4 md:flex md:py-2">
        <router-link to="/">
          <img
            src="assets/brand/logo.png"
            class="logo mx-auto md:mx-0"
            alt="Logo Samu"
          />
        </router-link>
      </div>
    </header>

    <main class="bg-gray-200">
      <slot></slot>
    </main>

    <footer class="text-black bg-cyan">
      <!--version desktop-->
      <div
        class="hidden container mx-auto md:flex md:flex-row md:justify-between py-3 flex-col justify-center items-center"
      >
        <span class="items-center uppercase font-extrabold md:mx-0 texto-100">
          {{ year }} samu.<span class="font-light"
            >Todos los derechos reservados &copy;</span
          >
        </span>
        <nav class="items-center texto-100">
          <router-link
            to="/condiciones-de-uso"
            class="cursor-pointer uppercase mr-5 md:hover:text-white hover:text-gray-500"
            >condiciones de uso</router-link
          >
          <router-link
            to="/aviso-de-privacidad"
            class="cursor-pointer uppercase mr-5 md:hover:text-white hover:text-gray-500"
            >aviso de privacidad</router-link
          >
          <router-link
            to="/ayuda"
            class="cursor-pointer uppercase mr-5 md:hover:text-white hover:text-gray-500"
            >ayuda</router-link
          >
        </nav>
      </div>
      <!--Version Mobile-->
      <div class="flex flex-col mx-auto text-center md:hidden">
        <span class="items-center uppercase font-extrabold texto-100 py-5">
          {{ year }} samu.<span class="font-light"
            >Todos los derechos reservados &copy;</span
          >
        </span>
        <nav class="items-center texto-100 w-full bg-gray-200 py-3">
          <router-link
            to="/condiciones-de-uso"
            class="cursor-pointer uppercase mr-3 md:hover:text-white hover:text-gray-500"
            >condiciones de uso</router-link
          >
          <router-link
            to="/aviso-de-privacidad"
            class="cursor-pointer uppercase mr-3 md:hover:text-white hover:text-gray-500"
            >aviso de privacidad</router-link
          >
          <router-link
            to="/ayuda"
            class="cursor-pointer uppercase mr-3 md:hover:text-white hover:text-gray-500"
            >ayuda</router-link
          >
        </nav>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: "AuthLayout",
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
};
</script>
<style>
.logo {
  width: 8rem;
  height: 4rem;
}

.texto-100 {
  font-size: 1rem;
}

@media (min-width: 1280px) {
  .texto-100 {
    font-size: 1.2rem;
  }
  footer {
    /* position: absolute; */
    /* bottom: 0; */
    /* width: 100%; */
    position: fixed;
    bottom: 0;
    width: 100%;
  }
}
</style>
