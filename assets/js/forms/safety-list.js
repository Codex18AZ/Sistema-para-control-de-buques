window.addEventListener("load", textAreaResize);

var textAreas = document.querySelectorAll("textarea");

for (let j = 0; j < textAreas.length; j++) {
    textAreas[j].addEventListener("input", textAreaResize, false);
}

/* Función para cambiar la altura del campo de texto en función a sus líneas */
function textAreaResize() {
    for (let j = 0; j < textAreas.length; j++) {
        var textArea = textAreas[j];
        var heightLimit = 80;

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