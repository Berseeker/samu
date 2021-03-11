<template>
    <AuthLayout>
        <div class="container mx-auto">
            <h1 class="text-center">En el panel!!</h1>
            <p>
                {{ usuario }}
            </p>

            <button @click="logout()" class=" text-uppercase bg-cyan p-3">
                CERRAR SESIÓN
            </button>
        </div>
    </AuthLayout>
</template>

<script>
import { mapState } from 'vuex';
import AuthLayout from "@/Layouts/AuthLayout";
export default {
    name: 'PanelIndex',
    components: {AuthLayout},
    computed: {
        ...mapState(['usuario',"token","url"])
    },
    methods: {
        logout() {
            axios.post(`${this.url}logout`,{},{
                headers: {
                    Authorization: this.token
                }
            }).then(res => {
               if (res.data.code === 200){
                   this.$router.push('/login');
               }
            });
        }
    },
}
</script>

<style scoped>

</style>
