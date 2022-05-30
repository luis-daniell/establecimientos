

document.addEventListener('DOMContentLoaded', () => {

    if(document.querySelector('#mapa')){
        const lat = 20.666332695977;
        const lng = -103.392177745699;

        const mapa = L.map('mapa').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

                // agregar el pin
        marker = new L.marker([lat, lng]).addTo(mapa);
    }

});














