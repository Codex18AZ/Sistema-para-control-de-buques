// Ejecuta la función cada vez que se carga la página
window.addEventListener("load", getStorageData);

// Arreglos de los elementos que contienen los datos
var details = document.querySelectorAll("#terminal-marino input");
var types = document.querySelectorAll("#tipo-transferencia input");
var shipInfo = document.querySelectorAll("#informacion-buque input");
var guardInfo = document.querySelectorAll("#informacion-personal input");
var mooringInfo = document.querySelectorAll("#informacion-amarre input");
var lines = document.querySelectorAll("#registro-lineas input");
var tugboats = document.querySelectorAll("#carnereo-remolcadores input");
var shipPerformance = document.querySelectorAll("#performance-nave input");
var pilotPerformance = document.querySelectorAll("#performance-practico input");
var observations = document.querySelectorAll("#observaciones input");

// Llama a las funciones correspondientes cada vez que se actualizan
for (let j = 0; j < details.length; j++) {
    details[j].addEventListener("input", setDetailsData, false);
}

for (let j = 4; j < types.length; j++) {
    types[j].addEventListener("input", setTypesData, false);
}

for (let j = 0; j < shipInfo.length; j++) {
    shipInfo[j].addEventListener("input", setShipInfoData, false);
}

for (let j = 0; j < guardInfo.length; j++) {
    guardInfo[j].addEventListener("input", setGuardInfoData, false);
}

for (let j = 0; j < mooringInfo.length; j++) {
    mooringInfo[j].addEventListener("input", setMooringInfoData, false);
}

for (let j = 0; j < lines.length; j++) {
    lines[j].addEventListener("input", setLinesData, false);
}

for (let j = 0; j < tugboats.length; j++) {
    tugboats[j].addEventListener("input", setTugboatsData, false);
}

for (let j = 0; j < shipPerformance.length; j++) {
    shipPerformance[j].addEventListener("input", setShipPerformanceData, false);
}

for (let j = 0; j < pilotPerformance.length; j++) {
    pilotPerformance[j].addEventListener("input", setPilotPerformanceData, false);
}

for (let j = 0; j < observations.length; j++) {
    observations[j].addEventListener("input", setObservationsData, false);
}

// Función para obtener la información guardada
function getStorageData() {
    if (localStorage.getItem("traSumDetails")) {
        let traSumDetails = JSON.parse(localStorage.getItem("traSumDetails"));

        for (let j = 2; j < details.length; j++) {
            details[j].value = traSumDetails[j];
        }
    }

    if (localStorage.getItem("traSumTypes")) {
        let traSumTypes = JSON.parse(localStorage.getItem("traSumTypes"));

        for (let j = 4; j < types.length; j++) {
            types[j].value = traSumTypes[j];
        }
    }

    if (localStorage.getItem("traSumShipInfo")) {
        let traSumShipInfo = JSON.parse(localStorage.getItem("traSumShipInfo"));

        for (let j = 0; j < shipInfo.length; j++) {
            shipInfo[j].value = traSumShipInfo[j];
        }
    }

    if (localStorage.getItem("traSumGuardInfo")) {
        let traSumGuardInfo = JSON.parse(localStorage.getItem("traSumGuardInfo"));

        for (let j = 0; j < guardInfo.length; j++) {
            guardInfo[j].value = traSumGuardInfo[j];
        }
    }

    if (localStorage.getItem("traSumMooringInfo")) {
        let traSumMooringInfo = JSON.parse(localStorage.getItem("traSumMooringInfo"));

        for (let j = 0; j < mooringInfo.length; j++) {
            mooringInfo[j].value = traSumMooringInfo[j];
        }
    }

    if (localStorage.getItem("traSumLines")) {
        let traSumLines = JSON.parse(localStorage.getItem("traSumLines"));

        for (let j = 0; j < lines.length; j++) {
            lines[j].value = traSumLines[j];
        }
    }

    if (localStorage.getItem("traSumTugboats")) {
        let traSumTugboats = JSON.parse(localStorage.getItem("traSumTugboats"));

        for (let j = 0; j < tugboats.length; j++) {
            tugboats[j].value = traSumTugboats[j];
        }
    }

    if (localStorage.getItem("traSumShipPerformance")) {
        let traSumShipPerformance = JSON.parse(localStorage.getItem("traSumShipPerformance"));

        for (let j = 0; j < shipPerformance.length; j++) {
            shipPerformance[j].value = traSumShipPerformance[j];
        }
    }

    if (localStorage.getItem("traSumPilotPerformance")) {
        let traSumPilotPerformance = JSON.parse(localStorage.getItem("traSumPilotPerformance"));

        for (let j = 0; j < pilotPerformance.length; j++) {
            pilotPerformance[j].value = traSumPilotPerformance[j];
        }
    }

    if (localStorage.getItem("traSumObservations")) {
        let traSumObservations = JSON.parse(localStorage.getItem("traSumObservations"));

        for (let j = 0; j < observations.length; j++) {
            observations[j].value = traSumObservations[j];
        }
    }
}

// Función de almacenado de los detalles
function setDetailsData() {
    let traSumDetails = [];

    for (let j = 2; j < details.length; j++) {
        traSumDetails[j] = details[j].value;
    }

    localStorage.setItem("traSumDetails", JSON.stringify(traSumDetails));
}

// Función de almacenado de los tipos de transferencia
function setTypesData() {
    let traSumTypes = [];

    for (let j = 4; j < types.length; j++) {
        traSumTypes[j] = types[j].value;
    }

    localStorage.setItem("traSumTypes", JSON.stringify(traSumTypes));
}

// Función de almacenado de la información del buque
function setShipInfoData() {
    let traSumShipInfo = [];

    for (let j = 0; j < shipInfo.length; j++) {
        traSumShipInfo[j] = shipInfo[j].value;
    }

    localStorage.setItem("traSumShipInfo", JSON.stringify(traSumShipInfo));
}

// Función de almacenado de la información del personal de guardia
function setGuardInfoData() {
    let traSumGuardInfo = [];

    for (let j = 0; j < guardInfo.length; j++) {
        traSumGuardInfo[j] = guardInfo[j].value;
    }

    localStorage.setItem("traSumGuardInfo", JSON.stringify(traSumGuardInfo));
}

// Función de almacenado de la información de amarre - desamarre
function setMooringInfoData() {
    let traSumMooringInfo = [];

    for (let j = 0; j < mooringInfo.length; j++) {
        traSumMooringInfo[j] = mooringInfo[j].value;
    }

    localStorage.setItem("traSumMooringInfo", JSON.stringify(traSumMooringInfo));
}

// Función de almacenado del registro de líneas
function setLinesData() {
    let traSumLines = [];

    for (let j = 0; j < lines.length; j++) {
        traSumLines[j] = lines[j].value;
    }

    localStorage.setItem("traSumLines", JSON.stringify(traSumLines));
}

// Función de almacenado del carnereo de remolcadores
function setTugboatsData() {
    let traSumTugboats = [];

    for (let j = 0; j < tugboats.length; j++) {
        traSumTugboats[j] = tugboats[j].value;
    }

    localStorage.setItem("traSumTugboats", JSON.stringify(traSumTugboats));
}

// Función de almacenado del performance de la nave
function setShipPerformanceData() {
    let traSumShipPerformance = [];

    for (let j = 0; j < shipPerformance.length; j++) {
        traSumShipPerformance[j] = shipPerformance[j].value;
    }

    localStorage.setItem("traSumShipPerformance", JSON.stringify(traSumShipPerformance));
}

// Función de almacenado del performance del práctico
function setPilotPerformanceData() {
    let traSumPilotPerformance = [];

    for (let j = 0; j < pilotPerformance.length; j++) {
        traSumPilotPerformance[j] = pilotPerformance[j].value;
    }

    localStorage.setItem("traSumPilotPerformance", JSON.stringify(traSumPilotPerformance));
}

// Función de almacenado de las observaciones
function setObservationsData() {
    let traSumObservations = [];

    for (let j = 0; j < observations.length; j++) {
        traSumObservations[j] = observations[j].value;
    }

    localStorage.setItem("traSumObservations", JSON.stringify(traSumObservations));
}

function clearFormData() {
    // Borra los datos en el formulario
    for (let j = 2; j < details.length; j++) {
        details[j].value = null;
    }

    for (let j = 4; j < types.length; j++) {
        types[j].value = null;
    }

    for (let j = 0; j < shipInfo.length; j++) {
        shipInfo[j].value = null;
    }

    for (let j = 0; j < guardInfo.length; j++) {
        guardInfo[j].value = null;
    }

    for (let j = 0; j < mooringInfo.length; j++) {
        mooringInfo[j].value = null;
    }

    for (let j = 0; j < lines.length; j++) {
        lines[j].value = null;
    }

    for (let j = 0; j < tugboats.length; j++) {
        tugboats[j].value = null;
    }

    for (let j = 0; j < shipPerformance.length; j++) {
        shipPerformance[j].value = null;
    }

    for (let j = 0; j < pilotPerformance.length; j++) {
        pilotPerformance[j].value = null;
    }

    for (let j = 0; j < observations.length; j++) {
        observations[j].value = null;
    }

    // Borra los datos almacenados localmente
    localStorage.removeItem("traSumDetails");
    localStorage.removeItem("traSumTypes");
    localStorage.removeItem("traSumShipInfo");
    localStorage.removeItem("traSumGuardInfo");
    localStorage.removeItem("traSumMooringInfo");
    localStorage.removeItem("traSumLines");
    localStorage.removeItem("traSumTugboats");
    localStorage.removeItem("traSumShipPerformance");
    localStorage.removeItem("traSumPilotPerformance");
    localStorage.removeItem("traSumObservations");
}