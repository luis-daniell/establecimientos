


document.addEventListener('DOMContentLoaded', () => {

    if( document.querySelector('#dropzone') ){
        Dropzone.autoDiscover = false;


        const dropzone = new Dropzone('div#dropzone', {
            url: '/imagenes/store',
            dictDefaultMessage: 'Sube hasta 10 imágenes',
            maxFiles:10,
            required: true,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },

            success: function(file, respuesta) {
                console.log(respuesta);
            },
            sending: function(file, xhr, formData){
                formData.append('uuid', document.querySelector('#uuid').value)
                console.log('Enviando...');
            }

        });
    }

})




