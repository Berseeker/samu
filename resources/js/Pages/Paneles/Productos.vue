<template>
    <div>
        <navbar-component/>
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
            <div class="contenedor-busqueda w-ful mt-4 mb-4 flex gap-2 ">
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
                    class="w-full bg-transparent rounded-full "
                />
            </div>



            <!-- COMPONENTE DE PRODUCTOS -->
            <div class="w-full bg-white border-none rounded-md mt-4 p-5">

                <producto-component/>
                <hr class="my-3 border-gray-800">

                <producto-component/>
                <hr class="my-3 border-gray-800">

                <producto-component/>

            </div>
        </div>
    </div>
</template>

<script>
import NavbarComponent from "@/components/ui/NavbarComponent.vue";
import ProductoComponent from "../../components/ui/ProductoComponent";

export default {
    components: {ProductoComponent, NavbarComponent},
    name: "Productos",
};
</script>

<style lang="scss" scoped>
.producto-contenedor-img {
    width: 200px;
}
</style>
