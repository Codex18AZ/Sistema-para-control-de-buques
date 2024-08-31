document.addEventListener('input', e => {
    if (e.target.matches('#users-search')) {
        // Número de resultados
        var results = 0;

        // Versión de escritorio
        document.querySelectorAll('#result-desktop').forEach(result => {
            // Revisa la información de las tres primeras celdas (nombre, correo y rol)
            if (result.children[0].textContent.toLowerCase().includes(e.target.value.toLowerCase()) ||
                result.children[1].textContent.toLowerCase().includes(e.target.value.toLowerCase()) ||
                result.children[2].textContent.toLowerCase().includes(e.target.value.toLowerCase())) {
                result.removeAttribute('class');
                results++;
            } else {
                result.classList.add('filter');
            }
        });

        // Versión móvil
        document.querySelectorAll('#result-mobile').forEach(result => {
            // Revisa la información de los tres primeros textos en el botón (correo, nombre y rol)
            if (result.lastElementChild.children[0].textContent.toLowerCase().includes(e.target.value.toLowerCase()) ||
                result.lastElementChild.children[1].textContent.toLowerCase().includes(e.target.value.toLowerCase()) ||
                result.lastElementChild.children[2].textContent.toLowerCase().includes(e.target.value.toLowerCase())) {
                result.removeAttribute('class');
            } else {
                result.classList.add('filter');
            }
        });

        // Muestra un texto si no se encontraron resultados
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