<template>
  <div class="bg-cyan flex justify-between">
    <div class="logo-height">
      <router-link to="/control-panel" class="mx-auto hidden">
        <img
          src="/assets/brand/logo.png"
          class="logo mx-auto"
          alt="Logo Samu"
        />
      </router-link>
    </div>
    <div class="flex items-center px-4 text-white">
      <a
        href="#"
        class="px-2 text-white texto-cairo-semi-bold texto-hover-morado"
        >Mi perfil</a
      >
      |
      <a
        href="#"
        class="px-2 text-white texto-cairo-semi-bold texto-hover-morado"
        >Ayuda</a
      >
      |
      <a
        href="#"
        class="px-2 text-white texto-cairo-semi-bold texto-hover-morado"
        >Cerrar sesión</a
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "NavbarComponent",
};
</script>

<style lang="scss" scoped>
.logo-height {
  height: 64px;
}
</style>