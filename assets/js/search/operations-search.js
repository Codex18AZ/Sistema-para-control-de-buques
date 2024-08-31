// Búsqueda con el nombre de buque y laycan
var search = document.getElementById('operations-search');
search.addEventListener("input", searching, false);

function searching() {
    var results = 0;

    // Versión de escritorio
    document.querySelectorAll('#result-desktop').forEach(result => {
        // Revisa la información de las celdas de buque y laycan
        if (result.children[1].textContent.toLowerCase().includes(search.value.toLowerCase()) ||
            result.children[2].textContent.toLowerCase().includes(search.value.toLowerCase())) {
            result.removeAttribute('class');
            results++;
        } else {
            result.classList.add('filter');
        }
    });

    // Versión móvil
    document.querySelectorAll('#result-mobile').forEach(result => {
        // Revisa la información de los textos de buque y laycan
        if (result.lastElementChild.children[1].textContent.toLowerCase().includes(search.value.toLowerCase()) ||
            result.lastElementChild.children[2].textContent.toLowerCase().includes(search.value.toLowerCase())) {
            result.removeAttribute('class');
        } else {
            result.classList.add('filter');
        }
    });

    if (results == 0) {
        document.querySelectorAll('#no-search-results').forEach(text => {
            text.removeAttribute('class');
        });

    } else {
        document.querySelectorAll('#no-search-results').forEach(text => {
            text.classList.add('filter');
        });
    }
}

// Búsqueda de operaciones finalizadas o no finalizadas
var unfinished = document.getElementById('unfinished');
unfinished.addEventListener("input", finishedOperations, false);

function finishedOperations() {
    if (unfinished.checked) {
        // Versión de escritorio
        document.querySelectorAll('#result-desktop').forEach(result => {
            if (result.children[3].textContent.includes("No finalizada")) {
                result.removeAttribute('class');
            }
        });

        // Versión móvil
        document.querySelectorAll('#result-mobile').forEach(result => {
            if (result.lastElementChild.children[3].textContent.includes("No finalizada")) {
                result.removeAttribute('class');
            }
        });
    } else {
        // Versión de escritorio
        document.querySelectorAll('#result-desktop').forEach(result => {
            if (result.children[3].textContent.includes("No finalizada")) {
                result.classList.add('filter');
            }
        });

        // Versión móvil
        document.querySelectorAll('#result-mobile').forEach(result => {
            if (result.lastElementChild.children[3].textContent.includes("No finalizada")) {
                result.classList.add('filter');
            }
        });
    }
}