window.preview_image = function(event, querySelector){ // Corregido el nombre del parámetro
    // recuperamos el input que desencadenó la acción
    let input = event.target;

    // recuperamos la etiqueta img donde se cargará la imagen
    let imgpreview = document.querySelector(querySelector);

    // verificamos si existe una imagen seleccionada
    if(!input.files.length) return;

    // recuperamos el archivo subido
    let file = input.files[0];

    // creamos la url
    let url = URL.createObjectURL(file);

    // modificamos el atributo src
    imgpreview.src = url;
}
