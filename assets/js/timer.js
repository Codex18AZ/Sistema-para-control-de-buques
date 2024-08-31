let segundos = 5;

window.addEventListener("load", tiempoRestante);

// Se ejecuta cada segundo restante
if (segundos > 0) {
    setInterval(tiempoRestante, 1000);
}

// Definimos y ejecutamos el temporizador
function tiempoRestante() {
    let txtSegundos;

    //Mostrar segundos en pantalla
    if (segundos < 10) {
        txtSegundos = `0${segundos}`;
    } else {
        txtSegundos = segundos;
    }

    document.getElementById('segundos').innerHTML = txtSegundos;

    if (segundos == 0) {
        // Ocultar temporizador
        document.getElementById('timer').style.display = 'none';

        // Mostrar inicio de sesión
        document.getElementById('login').style.display = 'flex';
    }

    segundos--;
}