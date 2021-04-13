<template>
  <div class="animate__animated animate__backInDown">
    <navbar-image-component />
    <div class="px-10 mt-10">
      <h1 class="text-dark text-2xl mb-5">Resumen General</h1>
      <div class="flex flex-col gap-3">
        <mini-card-component
          :valorTexto="'$4256'"
          :titulo="'venta total'"
          colorTitulo="cyan"
        />
        <mini-card-component
          :valorTexto="'50.000'"
          :titulo="'visitas'"
          colorTitulo="magenta"
        />
      </div>
    </div>
  </div>
</template>

<script>
import NavbarImageComponent from "@/components/ui/NavbarImageComponent.vue";
import MiniCardComponent from "@/components/ui/MiniCardComponent.vue";
export default {
  components: { NavbarImageComponent, MiniCardComponent },
  name: "PaneldeControl",
};
</script>

<style lang="scss" scoped>
</style>
