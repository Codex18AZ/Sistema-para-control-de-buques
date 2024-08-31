window.addEventListener("load", showRows);
window.addEventListener("load", requiredHours);

var dates = document.querySelectorAll(".date-input");
var drafts = document.querySelectorAll(".draft input");
var eventsRows = document.querySelectorAll("#events tr");

var dateInputs = document.querySelectorAll("#events tr td:nth-child(1) input");
var staTimeInputs = document.querySelectorAll("#events tr td:nth-child(2) input");
var endTimeInputs = document.querySelectorAll("#events tr td:nth-child(3) input");

/* for (let j = 0; j < dates.length; j++) {
    dates[j].addEventListener("input", consecutiveDates.bind(this, j), false);
} */

for (let j = 0; j < drafts.length; j++) {
    drafts[j].addEventListener("change", decimalRound, false);
}

for (let j = 0; j < events.length; j++) {
    events[j].addEventListener("input", requiredHours, false);
}

/* Función para colocar fechas automáticamente */
/* function consecutiveDates(index) {
    // Solo funcionará en el nuevo formulario
    if (document.URL.includes("new_form.php")) {
        for (let j = index; j < dates.length; j++) {
            if (dates[j + 1]) { // Si hay un input en la siguiente fila
                dates[j + 1].value = dates[j].value;

                // Almacena los datos en el LocalStorage
                setEventsData();
            }
        }
    }
} */

/* Función para colocar dos cifras decimales en las variables de calados */
function decimalRound() {
    for (let j = 0; j < drafts.length; j++) {
        var number = Number(drafts[j].value);

        if (number) {
            number = number.toFixed(2);
            drafts[j].value = number;
        }
    }
}

/* Función para mostrar filas ocultas que tienen contenido */
function showRows() {
    for (let j = 1; j < eventsRows.length; j++) {
        // Si hay una fila oculta
        if (eventsRows[j].style.display == 'none') {
            // Obtiene los campos de dicha fila
            let rowContent = eventsRows[j].querySelectorAll("#events input[type=date], #events input[type=time]");

            for (let k = 0; k < rowContent.length; k++) {
                // Si alguno de los campos tiene valores
                if (rowContent[k].value) {
                    eventsRows[j].style.display = 'table-row';

                    document.getElementById("opcion" + j).checked = true;

                    if (j >= 5 && j <= 8) {
                        document.getElementById("desplegable1").getElementsByTagName("details")[0].open = true;
                    }

                    if (j >= 21 && j <= 24) {
                        document.getElementById("desplegable2").getElementsByTagName("details")[0].open = true;
                    }

                    if (j >= 27 && j <= 39) {
                        document.getElementById("desplegable3").getElementsByTagName("details")[0].open = true;
                    }

                    if (j >= 46 && j <= 48) {
                        document.getElementById("desplegable4").getElementsByTagName("details")[0].open = true;
                    }
                }
            }
        }
    }
}

/* Funciones para mostrar los eventos de las filas ocultas */
let opciones = ['opcion5', 'opcion6', 'opcion7', 'opcion8', 'opcion21', 'opcion22', 'opcion23', 'opcion24', 'opcion27', 'opcion28', 'opcion29', 'opcion30', 'opcion31', 'opcion32', 'opcion33', 'opcion34', 'opcion35', 'opcion36', 'opcion37', 'opcion38', 'opcion39', 'opcion46', 'opcion47', 'opcion48'];

var i = 0;

for (let opcion of opciones) {
    document.getElementById(opcion).onclick = crearManejador(i);
    i++;
}

function crearManejador(index) {
    return function () {
        var fila = ['ocultarFila5', 'ocultarFila6', 'ocultarFila7', 'ocultarFila8', 'ocultarFila21', 'ocultarFila22', 'ocultarFila23', 'ocultarFila24', 'ocultarFila27', 'ocultarFila28', 'ocultarFila29', 'ocultarFila30', 'ocultarFila31', 'ocultarFila32', 'ocultarFila33', 'ocultarFila34', 'ocultarFila35', 'ocultarFila36', 'ocultarFila37', 'ocultarFila38', 'ocultarFila39', 'ocultarFila46', 'ocultarFila47', 'ocultarFila48'];
        mostrarOcultar6(fila[index]);
    };
}

function mostrarOcultar6(parametro) {
    var elemento1 = document.getElementById(parametro);
    if (elemento1.style.display === "none") {
        elemento1.style.display = "table-row"; // Muestra el elemento
    } else {
        elemento1.style.display = "none"; // Oculta el elemento
    }
}

/* Función para agregar nuevos eventos */
var tablaEventos = document.getElementById("events");
var numInput = tablaEventos.rows.length - 56;

if (tablaEventos != null) {
    document.getElementById("bNewRow").onclick = myNewRow;
}

function myNewRow() {
    var table = document.getElementById("events");

    // Inserta la fila al final de la tabla y sus celdas
    var row = table.insertRow(-1);
    row.classList.add("new-row");

    // Almacena los nuevos eventos en el LocalStorage
    if (document.URL.includes("new_form.php")) {
        row.addEventListener("input", setNewEventsData, false);
    }

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);

    if (numInput == 1) {
        cell1.innerHTML = "<input type='date' class='date-input' name='NewDate_" + numInput + "' min='2000-01-01'/>";
        cell2.innerHTML = "<input type='time' name='NewTimeStart_" + numInput + "'/>";
        cell3.innerHTML = "<input type='time' name='NewTimeEnd_" + numInput + "'/>";
        cell4.innerHTML = "<input type='text' name='NewEvent_" + numInput + "'><input type='hidden' id='cantNew' name='cantNew' value='" + numInput + "' readonly>";
    } else {
        cell1.innerHTML = "<input type='date' class='date-input' name='NewDate_" + numInput + "' min='2000-01-01'/>";
        cell2.innerHTML = "<input type='time' name='NewTimeStart_" + numInput + "'/>";
        cell3.innerHTML = "<input type='time' name='NewTimeEnd_" + numInput + "'/>";
        cell4.innerHTML = "<input type='text' name='NewEvent_" + numInput + "'>";

        // Asigna el nuevo número de filas al input correspondiente
        document.getElementById("cantNew").value = numInput;
    }

    numInput++;
}

/* Función para controlar las horas de los eventos */
function requiredHours() {
    for (let j = 0; j < dateInputs.length; j++) {
        if (dateInputs[j].value && !(staTimeInputs[j].value || endTimeInputs[j].value)) {
            endTimeInputs[j].required = true;
        } else {
            endTimeInputs[j].removeAttribute('required');
        }
    }
}

/* Oyente para evitar que se envíe el formulario al presionar Enter */
form.addEventListener("keydown", function (event) {
    if (event.key == "Enter") {
        event.preventDefault();
    }
});