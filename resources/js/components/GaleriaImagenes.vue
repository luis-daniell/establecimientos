
<template>
    <div>

        <h2 class="mt-4">Galería de imágenes</h2>

        <ul class="row list-unstyled mt-4">

            <li class="col-md-4 mb-4" v-for="imagen in imagenes" v-bind:key="imagen.id">
                <img class="img-fluid" :src='`/storage/${imagen.ruta_imagen}`'>

            </li>

        </ul>

    </div>
</template>

<script>

    export default {

        computed: {
            imagenes() {
                return this.$store.getters.obtenerImagenes
            }
        }



    }

</script>












