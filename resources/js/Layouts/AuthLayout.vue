<template>
    <div style="width: 100%">
        <header class="bg-cyan">
            <div class="container mx-auto py-4 md:flex md:py-2 ">
                <img src="assets/brand/logo.png" class="logo mx-auto md:mx-0 " alt="Logo Samu">
            </div>
        </header>

        <main class="h-100vh">
            <slot></slot>
        </main>

        <footer class="text-black bg-cyan">
            <!--version desktop-->
            <div
                class="hidden md:block container mx-auto md:flex md:flex-row md:justify-between py-3 flex-col justify-center items-center ">
                <a class="items-center uppercase font-extrabold md:mx-0 texto-100">
                    {{ year }} samu.<span class="font-light">Todos los derechos reservados &copy;</span>
                </a>
                <nav class="items-center texto-100">
                    <a class="cursor-pointer uppercase mr-5 md:hover:text-white hover:text-gray-500">condiciones de
                        uso</a>
                    <a class="cursor-pointer uppercase mr-5 md:hover:text-white hover:text-gray-500">aviso de
                        privacidad</a>
                    <a class="cursor-pointer uppercase mr-5 md:hover:text-white hover:text-gray-500">ayuda</a>
                </nav>
            </div>
            <!--Version Mobile-->
            <div class="flex flex-col mx-auto text-center  md:hidden ">
                <a class="items-center uppercase font-extrabold texto-100 py-5">
                    {{ year }} samu.<span class="font-light">Todos los derechos reservados &copy;</span>
                </a>
                <nav class="items-center texto-100 w-full bg-gray-200 py-3">
                    <a class="cursor-pointer uppercase mr-3 md:hover:text-white hover:text-gray-500">condiciones de
                        uso</a>
                    <a class="cursor-pointer uppercase mr-3 md:hover:text-white hover:text-gray-500">aviso de
                        privacidad</a>
                    <a class="cursor-pointer uppercase mr-3 md:hover:text-white hover:text-gray-500">ayuda</a>
                </nav>
            </div>
        </footer>
    </div>
</template>

<script>

export default {
    name: 'AuthLayout',
    data() {
        return {
            year: new Date().getFullYear()
        }
    }
}
</script>
<style>
.logo {
    width: 8rem;
    height: 4rem;
}

footer {
    position: fixed;
    bottom: 0;
    width: 100%;
}

.texto-100 {
    font-size: 1rem;
}

.h-100vh {
    /*height: calc(100vh - 100px);*/
    height: auto;
    /*overflow-y: hidden;*/
}
@media (min-width: 1280px) {
    .texto-100 {
        font-size: 1.2rem;
    }
}
</style>
