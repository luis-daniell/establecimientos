
<template>

    <div class="mapa">
        <l-map
            :zoom="zoom"
            :center="center"
            :options="mapOptions"
        >
            <l-tile-layer :url="url" :attribution="attribution"/>

            <l-marker :lat-lng="{lat, lng}">
                <l-tooltip>
                    <div>{{ establecimiento.nombre }}</div>
                </l-tooltip>
            </l-marker>

        </l-map>

    </div>
</template>




<script>


import { latLng } from 'leaflet';
import { setTimeout } from 'timers';
import { LMap, LTileLayer, LMarker, LTooltip  } from 'vue2-leaflet';

    export default {
        components: {
            LMap,
            LTileLayer,
            LMarker,
            LTooltip
        },
        data() {
            return {
                zoom: 16,
                center: latLng(20.666332695977, -103.392177745699),
                url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                attribution:
                    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                currentZoom: 11.5,
                mapOptions: {
                    zoomSnap: 0.5
                },
                //showMap: true,
                lat: "",
                lng: ""
            };
        },
        created() {
            setTimeout( () =>{
                this.lat = this.$store.getters.obtenerEstablecimiento.lat;
                this.lng = this.$store.getters.obtenerEstablecimiento.lng;
                this.center = latLng(this.lat, this.lng);
            }, 1200)
        },


        computed: {

            establecimiento(){
                return this.$store.getters.obtenerEstablecimiento;
            }
        }

    }


</script>

<style scoped>

    @import 'https://unpkg.com/leaflet@1.8.0/dist/leaflet.css';
    .mapa{
        height: 300px;
        width: 100%;
    }
</style>






