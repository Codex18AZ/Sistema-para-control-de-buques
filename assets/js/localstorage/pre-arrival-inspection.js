// Ejecuta la función cada vez que se carga la página
window.addEventListener("load", getStorageData);

// Arreglos de los elementos que contienen los datos
var details = document.getElementsByClassName("detail");
var information = document.getElementsByClassName("information");
var signatures = document.getElementsByClassName("sign-data");

// Llama a las funciones correspondientes cada vez que se actualizan
for (let j = 0; j < details.length; j++) {
    details[j].addEventListener("input", setDetailsData, false);
}

for (let j = 0; j < information.length; j++) {
    information[j].addEventListener("input", setInformationData, false);
}

for (let j = 0; j < signatures.length; j++) {
    signatures[j].addEventListener("input", setSignaturesData, false);
}

// Función para obtener la información guardada
function getStorageData() {
    if (localStorage.getItem("preArrDetails")) {
        let preArrDetails = JSON.parse(localStorage.getItem("preArrDetails"));

        for (let j = 0; j < details.length; j++) {
            details[j].querySelector("input").value = preArrDetails[j];
        }
    }

    if (localStorage.getItem("preArrInformation")) {
        let preArrInformation = JSON.parse(localStorage.getItem("preArrInformation"));

        for (let j = 0; j < information.length; j++) {
            let informationData = JSON.parse(preArrInformation[j]);

            if (informationData[0] != null) {
                var selector = information[j].querySelector("select");
                let regExpDate = /^(20)[0-9]{2}\-(0[1-9]|1[0-2])\-(0[1-9]|[1-2][0-9]|3[01])$/;

                k = j + 1;
                var expiration = document.getElementsByName("exp" + k)[0];

                if (regExpDate.test(informationData[0])) {
                    selector.style.marginBottom = "7px";
                    selector.value = "Fecha de expiración";

                    expiration.type = "date";
                    expiration.min = "2000-01-01";
                } else {
                    selector.value != "Seleccione..."
                }

                if (informationData[0] == "") {
                    expiration.removeAttribute("value");
                } else {
                    expiration.value = informationData[0];
                }
            }

            if (informationData[1] != null) {
                information[j].querySelector("input[type=radio][value=" + informationData[1] + "]").checked = true;
            }

            information[j].querySelector("textarea").value = informationData[2];
        }
    }

    if (localStorage.getItem("preArrSignatures")) {
        let preArrSignatures = JSON.parse(localStorage.getItem("preArrSignatures"));

        for (let j = 0; j < signatures.length; j++) {
            signatures[j].querySelector("input").value = preArrSignatures[j];
        }
    }
}

// Función de almacenado de los detalles
function setDetailsData() {
    let preArrDetails = [];

    for (let j = 0; j < details.length; j++) {
        preArrDetails[j] = details[j].querySelector("input").value;
    }

    localStorage.setItem("preArrDetails", JSON.stringify(preArrDetails));
}

// Función de almacenado de la información
function setInformationData() {
    let preArrInformation = [];

    for (let j = 0; j < information.length; j++) {
        k = j + 1;
        var input = document.getElementsByName("exp" + k)[0];

        if (input == null) {
            var expiration = null;
        } else {
            var selector = information[j].querySelector("select");

            if (selector.value == "Ninguna") {
                var expiration = "";
            } else {
                var expiration = input.value;
            }
        }

        if (information[j].querySelector("input[type=radio]:checked") == null) {
            var accordance = null;
        } else {
            var accordance = information[j].querySelector("input[type=radio]:checked").value;
        }

        var observation = information[j].querySelector("textarea").value;

        preArrInformation[j] = JSON.stringify([expiration, accordance, observation]);
    }

    localStorage.setItem("preArrInformation", JSON.stringify(preArrInformation));
}

// Función de almacenado de las firmas
function setSignaturesData() {
    let preArrSignatures = [];

    for (let j = 0; j < signatures.length; j++) {
        preArrSignatures[j] = signatures[j].querySelector("input").value;
    }

    localStorage.setItem("preArrSignatures", JSON.stringify(preArrSignatures));
}

function clearFormData() {
    // Borra los datos en el formulario
    for (let j = 0; j < details.length; j++) {
        details[j].querySelector("input").value = null;
    }

    for (let j = 0; j < information.length; j++) {
        k = j + 1;
        var expiration = document.getElementsByName("exp" + k)[0];

        if (expiration != null) {
            expiration.value = null;
            expiration.removeAttribute("value");
            expiration.removeAttribute("min");
            expiration.type = "hidden";

            information[j].querySelector("select").selectedIndex = 0;

            if (information[j].querySelector("select").style.marginBottom = "7px") {
                information[j].querySelector("select").style.marginBottom = 0;
            }
        }

        if (information[j].querySelector("input[type=radio]:checked") != null) {
            if (information[j].querySelector("input[type=radio][value=si]").checked) {
                information[j].querySelector("input[type=radio][value=si]").checked = false;
            } else if (information[j].querySelector("input[type=radio][value=no]").checked) {
                information[j].querySelector("input[type=radio][value=no]").checked = false;
            } else {
                information[j].querySelector("input[type=radio][value=na]").checked = false;
            }
        }

        if (information[j].querySelector("textarea") != null) {
            information[j].querySelector("textarea").value = null;
        }
    }

    for (let j = 0; j < signatures.length; j++) {
        signatures[j].querySelector("input").value = null;
    }

    // Borra los datos almacenados localmente
    localStorage.removeItem("preArrDetails");
    localStorage.removeItem("preArrInformation");
    localStorage.removeItem("preArrSignatures");

    // Agrega los datos predeterminados
    details[1].querySelector("input").value = "Pisco - Perú";
    details[2].querySelector("input").value = "Pisco Camisea Marine Terminal";
    signatures[4].querySelector("input").value = "Loading Master";
}