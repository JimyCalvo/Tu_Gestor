// userInfo.js

$(document).ready(function() {
    // Recuperar el token de localStorage y mostrarlo en la consola
    var token = localStorage.getItem('token');
    console.log('Token obtenido de localStorage:', token);

    // Cargar información del usuario
    $.ajax({
        url: '/api/user',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
        },
        beforeSend: function() {
            // Mostrar los encabezados en la consola antes de enviar la solicitud
            console.log('Encabezado de Autorización:', 'Bearer ' + token);
        },
        success: function(response) {
            let formattedName = capitalizeWords(response.full_name);
            console.log('Nombre completo del usuario:', formattedName);
            $('#userName').text(formattedName);
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar la información del usuario:', xhr, status, error);
        }
    });

    // Función para capitalizar el nombre
    function capitalizeWords(str) {
        return str.replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
    }
});
