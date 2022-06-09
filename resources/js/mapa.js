import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();


document.addEventListener('DOMContentLoaded', () => {


    if(document.querySelector('#mapa')){
        const lat = document.querySelector('#lat').value === '' ? 17.0605423 : document.querySelector('#lat').value;
        const lng = document.querySelector('#lng').value === '' ? -96.7256293 : document.querySelector('#lng').value;
        //const lng = -96.7256293;

        const mapa = L.map('mapa').setView([lat, lng], 16);


        //Eliminar pines previos
        let markers = new L.FeatureGroup().addTo(mapa);





        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true

        }).addTo(mapa);


        //Agrega el PIN  a las capas
        markers.addLayer(marker);


        //Geocode Service
        // const geocodeService = L.esri.Geocoding.geocodeService();

        const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: 'AAPK95589e4330584b56a66acf16a772dab7TeycgdrPnvLaA43IECE5YnJCAez5WGCrL-HkU4OclyVH1zLZmSqSVpB6mZ1U738A' // reemplazamos con nuestra api key
        });



        //Buscador de direcciones

        const buscador = document.querySelector('#formbuscador');
        buscador.addEventListener('blur', buscarDireccion);


        reubicarPin(marker);

        function reubicarPin(marker){
            //Detectar movimiento del marker
            marker.on('moveend', function(e){
                marker = e.target;

                const posicion =marker.getLatLng();

                //Centrar Automaticamente
                mapa.panTo(new L.LatLng(posicion.lat, posicion.lng));

                //Reverse Geocoding, cuando el usuario reubica el pin
                geocodeService.reverse().latlng(posicion, 16).run( function(error, resultado){
                    //console.log(error);
                    //console.log(resultado.address);

                    marker.bindPopup(resultado.address.LongLabel);
                    marker.openPopup();


                    //Llenar los campos
                    llenarInputs(resultado);



                })
            });
        }



        function buscarDireccion(e){

            //console.log(provider);
            if(e.target.value.length > 10){


                provider.search({query: e.target.value + ' OAXACA MX '})
                    .then( resultado => {
                        if( resultado){

                            //Limpiar los pines previos
                            markers.clearLayers();

                            //Reverse Geocoding, cuando el usuario reubica el pin
                            geocodeService.reverse().latlng(resultado[0].bounds[0], 16).run( function(error, resultado){

                                //Llenar los inputs
                                llenarInputs(resultado);

                                //Centrar el mapa
                                mapa.setView(resultado.latlng, 16);


                                //Agregar el PIN
                                // agregar el pin
                                marker = new L.marker(resultado.latlng, {
                                    draggable: true,
                                    autoPan: true

                                }).addTo(mapa);

                                //Asignar el contenedor de markers el nuevo PIN
                                markers.addLayer(marker);



                                //Mover el PIN
                                reubicarPin(marker);
                            })
                        }
                    })
                    .catch( error => {
                        //console.log(error);
                    })


            }


        }


        function llenarInputs(resultado){


            document.querySelector('#direccion').value = resultado.address.Address || '';
            document.querySelector('#colonia').value = resultado.address.Neighborhood || '';

            document.querySelector('#lat').value = resultado.latlng.lat || '';
            document.querySelector('#lng').value = resultado.latlng.lng || '';


        }
    }
});














