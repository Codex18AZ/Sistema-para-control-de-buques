window.addEventListener("load", textAreaResize);

for (let j = 0; j < information.length; j++) {
    information[j].addEventListener("change", expirationTypes, false);
    information[j].addEventListener("input", textAreaResize, false);
}

/* Función para mostrar las alternativas de expiración */
function expirationTypes() {
    for (let j = 0; j < information.length; j++) {
        var selector = information[j].querySelector("select");

        if (selector != null) {
            k = j + 1;
            var expiration = document.getElementsByName("exp" + k)[0];
            expiration.removeAttribute("value");

            if (selector.value == "Fecha de expiración") {
                selector.style.marginBottom = "7px";
                expiration.type = "date";

                /* BUG CONOCIDO: el input de fecha no puede ingresarse debidamente 
                porque el mínimo se actualiza cada vez que se pone un número */
                /* expiration.min = "2000-01-01"; */
            } else {
                selector.style.marginBottom = 0;
                expiration.type = "hidden";
            }
        }
    }
}

/* Función para cambiar la altura del campo de texto en función a sus líneas */
function textAreaResize() {
    for (let j = 0; j < information.length; j++) {
        var textArea = information[j].querySelector("textarea");
        var heightLimit = 160;

        textArea.style.height = "";
        textArea.style.height = Math.min(textArea.scrollHeight, heightLimit) + "px";
    }
}

/* Oyente para evitar que se envíe el formulario al presionar Enter */
form.addEventListener("keydown", function (event) {
    if (event.key == "Enter" && !event.target.matches("textarea")) {
        event.preventDefault();
    }
});