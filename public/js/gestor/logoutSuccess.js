$(document).ready(function() {
    var logoutSuccess = localStorage.getItem('logoutSuccess');
    if (logoutSuccess) {
        // Mostrar el mensaje de éxito
        alert(logoutSuccess); // o puedes usar tu propio método de mostrar mensajes

        // Limpiar el mensaje para no mostrarlo nuevamente
        localStorage.removeItem('logoutSuccess');
    }
});
