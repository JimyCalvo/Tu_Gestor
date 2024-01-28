$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var token = localStorage.getItem('token');
    console.log('Token obtenido de localStorage:', token);
    // Cargar información del usuario
    $.ajax({
        url: '/api/user',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
        success: function (response) {
            let formattedName = capitalizeWords(response.full_name);
            console.log('Nombre completo del usuario:', formattedName);
            $('#userName').text(formattedName);
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar la información del usuario: ', xhr, status, error);
        }
    });

    // Función para capitalizar el nombre
    function capitalizeWords(str) {
        return str.replace(/\b[a-z]/g, function (letter) {
            return letter.toUpperCase();
        });
    }

    // Manejar el cierre de sesión
    $('#logoutButton').click(function () {
        $.ajax({
            url: '/api/logout',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                localStorage.removeItem('token');
                window.location.href = '/login';
            },
            error: function (xhr, status, error) {
                console.error('Error al cerrar sesión: ', xhr, status, error);
            }
        });
    });
});
