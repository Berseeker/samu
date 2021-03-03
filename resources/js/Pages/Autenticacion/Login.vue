<template>
    <AuthLayout>
        <section class="hero">
            <div class="hero-img"></div>
            <div class="container px-5 mx-auto mt-10 md:mt-0 lg:pt-20 flex sm:mb-40">
                <div
                    class="xl:w-1/3 lg:w-1/2  md:w-1/2 md:ml-auto lg:ml-auto w-full  md:mt-0 relative z-10 animate__animated animate__fadeInRight animate__slower">
                    <h1 class="uppercase text-black text-5xl uppercase my-5 font-extrabold">venda online con
                        samu.app</h1>
                    <p class="uppercase text-black text-xl">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad
                        assumenda</p>
                    <div class=" bg-white p-10 flex flex-col shadow-md mt-10">
                        <h2 class="text-black text-lg font-xl uppercase my-5 font-extrabold">Acceder a su cuenta</h2>
                        <!--                        <p class="leading-relaxed mb-5 text-gray-600">Post-ironic portland shabby chic echo park, banjo-->
                        <!--                            fashion axe</p>-->
                        <div class=" mb-4">
                            <input type="email" id="email" name="email" placeholder="E-mail"
                                   class="w-full bg-gray-300 border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class=" mb-4">
                            <input type="password" id="password" name="password" placeholder="Contraseña"
                                   class="w-full bg-gray-300 border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div class="mb-4">
                            <a href="#" class="text-blue-500 bg-white font-bold border-0 py-4 focus:outline-none">¿Olvidaste
                                tu contraseña?</a>
                        </div>
                        <div class="flex flex-row justify-between mb-5">
                            <button
                                class="uppercase text-white bg-black font-bold border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 text-lg">
                                Ingresar
                            </button>
                            <button
                                class="uppercase text-blue-500 bg-white font-bold border-0 py-2 px-6 focus:outline-none">
                                Crear una nueva cuenta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </AuthLayout>
</template>

<script>
import AuthLayout from "@/Layouts/AuthLayout";

export default {
    name: 'LoginScreen',
    components: {
        AuthLayout
    }
}
</script>

<style>
.hero {
    position: relative;
    height: calc(100vh + 40vh);
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
    background-image: url('/assets/brand/Bg_1_Movil.jpg');
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
        /*padding-top: 100px;*/
        /*margin-bottom: 70px;*/
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top center;
        background-image: url('/assets/brand/Bg_1.jpg');
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
