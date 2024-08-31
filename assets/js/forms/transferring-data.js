/* Oyente para evitar que se envíe el formulario al presionar Enter */
form.addEventListener("keydown", function (event) {
    if (event.key == "Enter") {
        event.preventDefault();
    }
});