
// Modificando el footer para que se ponga al final de la página
if (document.getElementsByClassName('footer')) { var footer = document.getElementsByClassName(''); }
// Obtén el div
var divpdf = document.getElementById("pdf-content");

const alturaContenidoDiv = divpdf.clientHeight;

console.log("Altura del contenido del div, gato actualizado 2:", alturaContenidoDiv);
// Altura del contenido después de la cual quieres agregar un marco
var topModificar = 0.0; // Ajusta este valor según tus necesidades

// Altura de una hoja A4 en píxeles (puede variar dependiendo de la resolución de la pantalla)
var alturaA4 = 277.548; // una pulgada = 96 px / es menos
let topA = 0.001;
const cantidadMarcos = (alturaContenidoDiv) / (985); // 351.59 constante por el aumento de la página por saltos y el margen de los lados que alarga el tamaño final, pero se toma el tamaño inicial del documento
console.log(cantidadMarcos);

// Crea los marcos según el contenido
for (let i = 0; i < cantidadMarcos; i++) {

  // Crea un nuevo div para el marco
  var marco = document.createElement("div");

  // Establece el estilo del marco
  marco.style.position = "absolute";
  if (i==0) {
    marco.style.top = 0 + "mm";
    
  } else {
    marco.style.top = topA + "mm";
    
  }
  marco.style.height = alturaA4 + "mm";
  marco.style.margin = 0;
  marco.style.padding = 0;
  marco.style.left = 0;
  marco.style.width = "100%";
  
  marco.style.border = "1mm solid #004EA3";
  marco.style.pageBreakAfter = 'always';

  topA = topA + alturaA4 + 0;

  // Agrega el marco al div
  divpdf.appendChild(marco);

}

// ¿Esto lo hizo un humano? yes, I'm one