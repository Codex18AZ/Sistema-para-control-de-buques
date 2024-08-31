document.addEventListener('input', e => {
    if (e.target.matches('#reports-search')) {
        var results = 0;

        // Versión de escritorio
        document.querySelectorAll('#result-desktop').forEach(result => {
            // Revisa la información de la segunda, tercera y cuarta celda (buque, operación y producto a transferir)
            if (result.children[1].textContent.toLowerCase().includes(e.target.value.toLowerCase()) ||
                result.children[2].textContent.toLowerCase().includes(e.target.value.toLowerCase()) ||
                result.children[3].textContent.toLowerCase().includes(e.target.value.toLowerCase())) {
                result.removeAttribute('class');
                results++;
            } else {
                result.classList.add('filter');
            }
        });

        // Versión móvil
        document.querySelectorAll('#result-mobile').forEach(result => {
            // Revisa la información del segundo, cuarto y quinto texto en el botón (buque, operación y producto a transferir)
            if (result.lastElementChild.children[1].textContent.toLowerCase().includes(e.target.value.toLowerCase()) ||
                result.lastElementChild.children[2].textContent.toLowerCase().includes(e.target.value.toLowerCase()) ||
                result.lastElementChild.children[3].textContent.toLowerCase().includes(e.target.value.toLowerCase())) {
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
});