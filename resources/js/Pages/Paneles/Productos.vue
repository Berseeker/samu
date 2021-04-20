<template>
  <div>
    <navbar-component />
    <div class="px-10 mt-10 animate__animated animate__fadeInUp">
      <h1 class="text-dark texto-cairo-bold text-5xl mb-5">Productos</h1>
      <!-- ACCIONES -->
      <div class="w-full">
        <button
          class="texto-color-cyan texto-cairo-bold focus:outline-none text-2xl mr-2"
        >
          + Nuevo producto
        </button>
        .
        <button class="texto-hover-cyan focus:outline-none text-2xl ml-2">
          Importar produtos
        </button>
      </div>
      <!-- BUSCADOR/FILTRO -->
      <div class="contenedor-busqueda w-ful mt-4 flex gap-2">
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
      <!-- COMPONENTE DE PRODUCTOS -->
      <div class="w-full">
        <div class="contenedor-producto flex gap-2">
          <div class="producto-contenedor-img max-w-xs">
            <img src="/assets/img/Foto_Producto.jpg" class="w-full" alt="Foto del Producto" />
          </div>
          <div class="producto-contenedor-data w-full flex justify-between">
            <div class="producto-informacion">
              <h3 class="uppercase texto-cairo-bold">camiseta essentials</h3>
              <h4 class="uppercase texto-cairo-bold">linear logo</h4>
            </div>
            <div class="producto-precio flex flex-col">
                <span>$87.000</span>
                <button>Editar</button>
            </div>
          </div>
        </div>
      </div>
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
