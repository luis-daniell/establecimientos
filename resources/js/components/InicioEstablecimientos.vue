
<template>

    <div>
        <listado-categorias></listado-categorias>
        <mapa-establecimientos></mapa-establecimientos>
        <categoria-cafe></categoria-cafe>
        <categoria-restaurant></categoria-restaurant>
        <categoria-hotel></categoria-hotel>
    </div>

</template>

<script>


    import CategoriaCafe from './CategoriaCafe';
    import CategoriaRestaurant from './CategoriaRestaurant';
    import CategoriaHotel from './CategoriaHotel';
    import MapaEstablecimientos from './MapaEstablecimientos';
    import ListadoCategorias from './ListadoCategorias';


    export default {

        components: {
            ListadoCategorias,
            MapaEstablecimientos,
            CategoriaCafe,
            CategoriaRestaurant,
            CategoriaHotel

        }
    }

</script>




