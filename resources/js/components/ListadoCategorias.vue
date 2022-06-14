
<template>

    <div class="">
        <nav class="d-flex flex-column flex-md-row container justify-content-md-center">


            <a
                v-for="categoria in categorias"
                v-bind:key="categoria.id"
                class="m-0"
            >
                {{ categoria.nombre }}

            </a>

        </nav>

    </div>

</template>

<script>

    export default {
        created() {
            axios.get('/api/categorias')
                .then( respuesta => {
                    this.$store.commit('AGREGAR_CATEGORIAS', respuesta.data)
                })
        },

        computed:{
            categorias(){
                return this.$store.getters.obtenerCategorias
            }
        }

    }

</script>

<style scoped>
div {
  background-color: #6272d4;
}
nav a {
  color: white;
  font-weight: bold;
  text-transform: uppercase;
  padding: 0.5rem 2rem;
  text-align: center;
  flex: 1;
}
nav a:hover {
  color: white;
  cursor: pointer;
}
nav a:nth-child(1) {
  background-color: #a000b7;
}
nav a:nth-child(2) {
  background-color: #591d03;
}
nav a:nth-child(3) {
  background-color: #ea6a00;
}
nav a:nth-child(4) {
  background-color: #edb220;
}
nav a:nth-child(5) {
  background-color: #dd0e3f;
}
nav a:nth-child(6) {
  background-color: #0448b5;
}
nav a:nth-child(7) {
  background-color: #00a81c;
}
</style>




