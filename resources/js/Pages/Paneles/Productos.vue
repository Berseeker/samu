<template>
  <div>
    <navbar-component />
    <div class="px-10 mt-10 animate__animated animate__fadeInUp">
      <h1 class="text-dark texto-cairo-bold text-5xl">Productos</h1>
    </div>
  </div>
</template>

<script>
import NavbarComponent from "@/components/ui/NavbarComponent.vue";
export default {
  components: { NavbarComponent },
  name: "Productos",
};
</script>

<style lang="scss" scoped>
</style>
