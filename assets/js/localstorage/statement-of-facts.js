// Ejecuta la función cada vez que se carga la página
window.addEventListener("load", getStorageData);

// Arreglos de los elementos que contienen los datos
var details = document.querySelectorAll(".detail input");
var events = document.querySelectorAll("#events input[type=date], #events input[type=time]");
var shipment = document.querySelectorAll(".ship-info input");

// Llama a las funciones correspondientes cada vez que se actualizan
for (let j = 0; j < details.length; j++) {
    details[j].addEventListener("input", setDetailsData, false);
}

for (let j = 0; j < events.length; j++) {
    events[j].addEventListener("input", setEventsData, false);
}

for (let j = 0; j < shipment.length; j++) {
    shipment[j].addEventListener("input", setShipmentData, false);
}

// Función para obtener la información guardada
function getStorageData() {
    if (localStorage.getItem("staFacDetails")) {
        let staFacDetails = JSON.parse(localStorage.getItem("staFacDetails"));

        for (let j = 2; j < details.length; j++) {
            details[j].value = staFacDetails[j];
        }
    }

    if (localStorage.getItem("staFacEvents")) {
        let staFacEvents = JSON.parse(localStorage.getItem("staFacEvents"));

        for (let j = 0; j < events.length; j++) {
            events[j].value = staFacEvents[j];
        }
    }

    if (localStorage.getItem("staFacNewEvents")) {
        let staFacNewEvents = JSON.parse(localStorage.getItem("staFacNewEvents"));

        // Se agregan las filas necesarias para ingresar la información
        for (let j = 0; j < staFacNewEvents.length / 5; j++) {
            myNewRow();
        }

        var newEvents = document.querySelectorAll(".new-row td input");

        for (let j = 0; j < staFacNewEvents.length; j++) {
            newEvents[j].value = staFacNewEvents[j];
        }
    }

    if (localStorage.getItem("staFacShipment")) {
        let staFacShipment = JSON.parse(localStorage.getItem("staFacShipment"));

        for (let j = 0; j < shipment.length; j++) {
            shipment[j].value = staFacShipment[j];
        }
    }
}

// Función de almacenado de los detalles
function setDetailsData() {
    let staFacDetails = [];

    for (let j = 2; j < details.length; j++) {
        staFacDetails[j] = details[j].value;
    }

    localStorage.setItem("staFacDetails", JSON.stringify(staFacDetails));
}

// Función de almacenado de los eventos
function setEventsData() {
    let staFacEvents = [];

    for (let j = 0; j < events.length; j++) {
        staFacEvents[j] = events[j].value;
    }

    localStorage.setItem("staFacEvents", JSON.stringify(staFacEvents));
}

// Función de almacenado de nuevos eventos
function setNewEventsData() {
    var newEvents = document.querySelectorAll(".new-row td input");
    let staFacNewEvents = [];

    for (let j = 0; j < newEvents.length; j++) {
        staFacNewEvents[j] = newEvents[j].value;
    }

    localStorage.setItem("staFacNewEvents", JSON.stringify(staFacNewEvents));
}

// Función de almacenado de la información del embarque
function setShipmentData() {
    let staFacShipment = [];

    for (let j = 0; j < shipment.length; j++) {
        staFacShipment[j] = shipment[j].value;
    }

    localStorage.setItem("staFacShipment", JSON.stringify(staFacShipment));
}

function clearFormData() {
    // Borra los datos en el formulario
    for (let j = 2; j < details.length; j++) {
        details[j].value = null;
    }

    for (let j = 0; j < events.length; j++) {
        events[j].value = null;
    }

    for (let j = 0; j < shipment.length; j++) {
        shipment[j].value = null;
    }

    // Borra los datos almacenados localmente
    localStorage.removeItem("staFacDetails");
    localStorage.removeItem("staFacEvents");
    localStorage.removeItem("staFacNewEvents");
    localStorage.removeItem("staFacShipment");

    // Verifica los campos de las fechas y horas de los eventos
    requiredHours();
}