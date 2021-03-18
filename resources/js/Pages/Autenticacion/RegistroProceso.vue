<template>
  <AuthLayout>
    <div class="container mx-auto overflow-y-hidden">
      <div class="flex flex-wrap justify-center">
        <div class="w-full max-w-2xl mx-10 md:mx-0  mt-20 animate__animated animate__fadeInUp">
          <h1 class="uppercase text-black text-5xl my-5 font-extrabold">
            COMPLETE EL FORMULARIO
          </h1>
          <p class="uppercase text-black text-xl">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad
            assumenda
          </p>
          <div class="bg-white p-5 flex flex-col shadow-md mt-10">
            <h2 class="text-black text-lg font-xl uppercase font-extrabold">
              Datos de la Tienda
            </h2>
            <div v-if="loading" class="flex mx-auto py-5">
              <spin-component />
            </div>
            <div v-else>
              <div class="my-4">
                <input
                  type="nombre_tienda"
                  id="nombre_tienda"
                  name="nombre_tienda"
                  placeholder="Nombre de Tienda"
                  v-model="formulario_login.email"
                  autocomplete="off"
                  class="w-full bg-gray-300 border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                  :class="{
                    'border-red-500': error,
                    'border-4': error,
                  }"
                />
              </div>
              <div class="my-4">
                <input
                  type="categeoria"
                  id="categeoria"
                  name="categeoria"
                  placeholder="Categoria"
                  v-model="formulario_login.email"
                  autocomplete="off"
                  class="w-full bg-gray-300 border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                  :class="{
                    'border-red-500': error,
                    'border-4': error,
                  }"
                />
              </div>

              <alert-component v-if="error" :msg="msgError" />

              <div class="container__auth-botones mb-5">
                <button
                  class="w-auto uppercase text-white bg-black font-bold border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 text-lg"
                  @click="validar"
                >
                  Registrar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthLayout>
</template>

<script>
import AuthLayout from "@/Layouts/AuthLayout";

export default {
  name: "Condiciones",
  components: {
    AuthLayout,
  },
  data() {
    return {
      error: false,
      msgError: "",
      loading: false,
      formulario_login: {
        email: null,
        // password: null,
      },
    };
  },
};
</script>

<style lang="scss" scoped>
</style>
