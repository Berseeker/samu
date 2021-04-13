<template>
  <div class="bg-white mini-card rounded-lg flex justify-around">
    <div class="flex flex-col ml-4 mt-8">
      <span
        :class="`texto-color-${colorTitulo}`"
        class="texto-cairo-bold text-5xl"
        >{{ valorTexto }}</span
      >
      <span class="uppercase texto-cairo-bold">{{ titulo }}</span>
    </div>
    <div class="minicard-contenedor__imagen flex justify-center items-center">
      <img
        src="/assets/brand/isologo.png"
        alt="ISOLOGO"
        class="bg-cyan minicard-avatar"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "MiniCardComponent",
  props: {
    titulo: {
      type: String,
      default: "",
    },
    valorTexto: {
      type: String|| Number,
      default: "",
    },
    colorTitulo: {
      type: String,
      default: "",
    },
  },
};
</script>

<style lang="scss" scoped>
.mini-card {
  width: 300px;
  height: 150px;
}

.minicard-avatar {
  max-height: 80px;
  border-radius: 50%;
}
</style>
