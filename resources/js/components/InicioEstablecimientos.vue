
<template>

    <div>
        <categoria-cafe></categoria-cafe>
        <categoria-restaurant></categoria-restaurant>
        <categoria-hotel></categoria-hotel>
    </div>

</template>

<script>


    import CategoriaCafe from './CategoriaCafe';
    import CategoriaRestaurant from './CategoriaRestaurant';
    import CategoriaHotel from './CategoriaHotel';


    export default {

        components: {
            CategoriaCafe,
            CategoriaRestaurant,
            CategoriaHotel

        }
    }

</script>




