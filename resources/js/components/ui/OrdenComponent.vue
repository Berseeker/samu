<template>
    <div class="contenedor-producto flex gap-5 mt-5">
        <div class="producto-contenedor-img ">
            <img
                :src="imagenProducto"
                class="w-full rounded-lg"
                alt="Foto del Producto"
            />
        </div>
        <div class="producto-contenedor-data w-full flex justify-between items-center">
            <div class="producto-informacion">
                <h3 class="uppercase texto-cairo-bold text-3xl ">
                    <span class="texto-cairo-bold texto-color-cyan">{{ pedidoNumero }} -</span> {{ fecha }}
                </h3>
                <h3 class="uppercase texto-cairo-semi-bold text-3xl ">{{ pedidoNombre }}</h3>
                <h4 class="uppercase texto-cairo-semi-bold text-3xl ">{{ pedidoSubnombre }}</h4>
                <div class="flex gap-3">
                    <span class="text-xl texto-cairo-semi-bold">Cantidad: {{ cantidad }} </span> |
                    <span class="text-xl texto-cairo-semi-bold">Talla: {{ talla }} </span> |
                    <span class="text-xl texto-cairo-semi-bold" :class="`texto-color-${pedidoColor}`" >{{ estadoPedido }}</span>
                </div>
            </div>
            <div class="producto-precio flex flex-col items-end">
                <span class="texto-cairo-bold  text-3xl">{{ precio }}</span>
                <button class="texto-color-cyan text-xl">Imprimir factura</button>
                <button class="texto-color-cyan text-xl">Editar</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrdenComponent",
    props: {
        pedidoNumero: {
            type: Number,
            default: 1
        },
        pedidoNombre: {
            type: String,
            default: ''
        },
        pedidoSubnombre: {
            type: String,
            default: ''
        },
        pedidoColor: {
            type: String,
            default: 'cyan'
        },
        fecha: {
            type: String,
            default: ''
        },
        cantidad: {
            type: Number,
            default: 1
        },
        talla: {
            type: String,
            default: 'L'
        },
        estadoPedido: {
            type: String,
            default: 'Procesando'
        },
        precio: {
            type: String,
            default: '0.000'
        },
        imagenProducto: {
            type: String,
            default: '/assets/img/Foto_Producto.jpg'
        }

    },
}
</script>

<style scoped>
.producto-contenedor-img {
    width: 200px;
}
</style>
