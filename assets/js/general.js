window.addEventListener("load", main);
window.addEventListener("scroll", navbar);

form = document.getElementById("form");

function main() {
    if (document.querySelector('#toggle-button') != null) {
        const toggleButton = document.querySelector('#toggle-button');
        const sidebar = document.querySelector('#sidebar');

        // Abre y cierra el menú desplegable
        toggleButton.addEventListener('click', function () {
            sidebar.classList.toggle('open');
        });

        // Cierra el menú desplegable
        document.getElementById("content").addEventListener('click', function () {
            sidebar.classList.remove('open');
        });
    }

    // Botón de verificación del formulario
    if (document.getElementById("guardar-boton") != null) {
        document.getElementById("guardar-boton").onclick = mostrarVerificacion;
        document.getElementById("ocultarVerificacion").onclick = ocultarVerificacion;
    }

    // Botón para imprimir el formulario
    if (document.getElementById("botonImprimir") != null) {
        document.getElementById("botonImprimir").onclick = imprimirPagina;
    }
}

function mostrarVerificacion() {
    document.getElementById('verificacion').style.display = 'block';
}

function ocultarVerificacion() {
    document.getElementById('verificacion').style.display = 'none';
}

/* Función que controla el desplazamiento del menú de navegación */
function navbar() {
    var menu = document.querySelector(".menu");
    var content = document.getElementById("content");
    var offset = menu.offsetTop;

    if (window.scrollY >= offset) {
        menu.style.position = "fixed";
        menu.style.top = "0";

        if (document.querySelector(".pdf-content") != null) {
            content.style.marginTop = "74px";
        } else {
            content.style.marginTop = "59px";
        }
    } else {
        menu.style.position = "relative";
        content.style.marginTop = "0";
    }
}

/* Función para guardar formularios no terminados */
function saveUnfinishedForm() {
    form.action = "processes/form_saving.php";
    form.submit();
}