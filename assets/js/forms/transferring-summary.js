var drafts = document.querySelectorAll(".draft input");

for (let j = 0; j < drafts.length; j++) {
    drafts[j].addEventListener("change", decimalRound, false);
}

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

/* Oyente para evitar que se envíe el formulario al presionar Enter */
form.addEventListener("keydown", function (event) {
    if (event.key == "Enter") {
        event.preventDefault();
    }
});

if (document.getElementById("selectRemolcador") && document.getElementById("remolcador")) {
    var selectElement = document.getElementById("selectRemolcador");
    var textElement = document.getElementById("remolcador");

    selectElement.addEventListener("change", function () {
        var valorSeleccionado = selectElement.value;
        if (textElement.value == null || textElement.value == '') {

        } else {
            valorSeleccionado = ', ' + valorSeleccionado;
        }
        textElement.value = textElement.value + valorSeleccionado;
    });



    var selectElement2 = document.getElementById("selectLanchas");
    var textElement2 = document.getElementById("lanchas");

    selectElement2.addEventListener("change", function () {
        var valorSeleccionado2 = selectElement2.value;
        if (textElement2.value == null || textElement2.value == '') {

        } else {
            valorSeleccionado2 = ', ' + valorSeleccionado2;
        }
        textElement2.value = textElement2.value + valorSeleccionado2;
    });
}
    var selectElement3 = document.getElementById("selectLoadingMaster");
    var textElement3 = document.getElementById("LoadingMaster");

    selectElement3.addEventListener("change", function () {
        var valorSeleccionado3 = selectElement3.value;
        if (textElement3.value == null || textElement3.value == '') {

        } else {
            valorSeleccionado3 = ', ' + valorSeleccionado3;
        }
        textElement3.value = textElement3.value + valorSeleccionado3;
    });