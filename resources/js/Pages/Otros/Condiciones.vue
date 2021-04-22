<template>
  <AuthLayout>
    <div class="hero">
      <div class="hero-img"></div>
      <div class="container mx-auto overflow-y-hiddens">
        <div class="flex flex-wrap justify-center">
          <div
            class="w-full mb-20 max-h-auto max-w-6xl mx-10 md:mx-0 my-20 animate__animated animate__fadeInUp"
          >
            <h2 class="uppercase text-black text-5xl my-5 font-extrabold">
              Condiciones de Uso
            </h2>

            <div class="bg-white p-5 flex flex-col shadow-md mt-10">
              <!-- <h2 class="text-black text-lg font-xl uppercase font-extrabold">
              Recuperar Contraseña
            </h2> -->
              <p class="uppercase text-black text-xl">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad
                assumenda
              </p>
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
.hero {
  position: relative;
  height: calc(100vh);
  overflow-x: hidden;
  overflow-y: hidden;
}

@media (min-width: 1280px) {
  .hero {
    position: relative;
    height: calc(100vh - 132px);
    overflow-x: hidden;
    overflow-y: hidden;
  }
}

.hero-img {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: top center;
  background-image: url("/assets/brand/02_Fondo_mosaico.jpg");
}

@media (min-width: 768px) {
  .hero {
    position: relative;
    height: calc(100vh);
    overflow-x: hidden;
    overflow-y: hidden;
  }

  .hero-img {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top center;
    background-image: url("/assets/brand/02_Fondo_mosaico.jpg");
  }
}

@media (min-width: 1280px) {
  .hero {
    position: relative;
    height: calc(100vh - 132px);
    overflow-x: hidden;
    overflow-y: hidden;
  }
}
</style>
