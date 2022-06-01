import './bootstrap';
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
// Funcionalidad de dropzone
const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png, .jpg, .jpeg, .git',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar imagen',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    },
});

// dropzone.on('sending', (file, xhr, formData) => {
//     // console.log(file);
//     // console.log(xhr);
//     // console.log(formData);
// })

dropzone.on('success', (file, response) => {
    // console.log(file);
    // console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
})
// dropzone.on('error', (file, message) => {
//     console.log(file);
//     console.log(message);
// })
dropzone.on('removedfile', () => {
    // console.log("Archivo eliminado");
    document.querySelector('[name="imagen"]').value = "";

})

