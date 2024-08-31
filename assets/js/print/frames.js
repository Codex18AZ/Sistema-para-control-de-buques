// Obtiene la altura del contenido
var pdf = document.getElementById("pdf-content");
const altura = pdf.clientHeight;

// Altura de una hoja A4 en píxeles (puede variar dependiendo de la resolución de la pantalla)
var alturaA4 = 277.548;
var topA = 0.001;
const cantidadMarcos = altura / 955;

// Crea los marcos según el contenido
for (let i = 0; i < cantidadMarcos; i++) {

    // Crea un nuevo div para el marco
    var marco = document.createElement("div");

    // Establece el estilo del marco
    marco.style.position = "absolute";

    if (i == 0) {
        marco.style.top = 0 + "mm";
    } else {
        marco.style.top = topA + "mm";
    }

    marco.style.margin = 0;
    marco.style.padding = 0;
    marco.style.left = 0;

    marco.style.width = "100%";
    marco.style.height = alturaA4 + "mm";

    marco.style.border = "1mm solid #004EA3";
    marco.style.pageBreakAfter = 'always';

    topA += alturaA4;

    // Agrega el marco al div
    pdf.appendChild(marco);
}