<template>
  <div>
    <navbar-image-component />
    <div class="px-10 mt-10 animate__animated animate__fadeInUp">
      <h1 class="text-dark text-4xl">Resumen General</h1>
    </div>
  </div>
</template>

<script>
import NavbarImageComponent from "@/components/ui/NavbarImageComponent.vue";
export default {
  components: { NavbarImageComponent },
  name: "PaneldeControl",
};
</script>

<style lang="scss" scoped>
</style>
