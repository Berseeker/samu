<template>
    <div class="contenedor-producto flex gap-5 mt-5">
        <div class="producto-contenedor-img ">
            <img
                src="/assets/img/Foto_Producto.jpg"
                class="w-full rounded-lg"
                alt="Foto del Producto"
            />
        </div>
        <div class="producto-contenedor-data w-full flex justify-between items-center">
            <div class="producto-informacion">
                <h3 class="uppercase texto-cairo-bold text-3xl ">camiseta essentials</h3>
                <h4 class="uppercase texto-cairo-bold text-3xl ">linear logo</h4>
                <div class="flex gap-1">
                    <span class="text-xl texto-cairo-semi-bold">Cantidad: 20 </span> |
                    <span class="text-xl texto-color-cyan texto-cairo-semi-bold">Disponible</span>
                </div>
            </div>
            <div class="producto-precio flex flex-col">
                <span class="texto-cairo-bold  text-3xl">$87.000</span>
                <button class="texto-color-cyan text-3xl">Editar</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductoComponent"
}
</script>

<style scoped>
.producto-contenedor-img {
    width: 200px;
}
</style>
