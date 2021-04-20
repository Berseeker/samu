<template>
  <div>
    <navbar-component />
    <div class="px-10 mt-10 animate__animated animate__fadeInUp">
      <h1 class="text-dark texto-cairo-bold text-5xl mb-5">Ordenes</h1>
      <div class="contenedor-busqueda mt-4 flex gap-2">
        <select
          name="filtro"
          id="filtro"
          class="bg-transparent border-none texto-cairo-semi-bold text-2xl focus:outline-none"
        >
          <option value="filtrar">Filtrar</option>
        </select>
        <input
          type="text"
          placeholder="Nombre del producto o referencia"
          class="w-full bg-transparent rounded-full"
        />
      </div>
    </div>
  </div>
</template>

<script>
import NavbarComponent from "../../components/ui/NavbarComponent.vue";
export default {
  components: { NavbarComponent },
  name: "OrdenesPage",
};
</script>

<style lang="scss" scoped>
</style>
