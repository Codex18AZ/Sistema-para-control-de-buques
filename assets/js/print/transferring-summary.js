/* Función que imprime el documento ya terminado */
function imprimirPagina() {
    var divContenido = document.getElementById("content");
    var ventana = window.open('', 'PRINT', 'height=793, width=1122');

    ventana.document.write('<html lang="es"><head> <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">');
    ventana.document.write('<title>' + document.title + '</title>');
    ventana.document.write('<link rel="stylesheet" href="../../../assets/css/forms/transferring-summary/printed-form.css">');
    ventana.document.write('</head><body>');

    ventana.document.write(divContenido.innerHTML);

    ventana.document.write('<script src="../../../assets/js/print/frames.js"></script>');
    ventana.document.write('</body></html>');
    ventana.document.close();

    ventana.focus();
    ventana.onload = function () {
        ventana.print();
        // ventana.close();
    };
}