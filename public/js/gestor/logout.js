
$(document).ready(function() {
    // Manejar el cierre de sesión
    $('#logoutButton').click(function() {
        var token = localStorage.getItem('token');
        $.ajax({
            url: '/api/logout',
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {
                localStorage.removeItem('token');
                localStorage.setItem('logoutSuccess', 'Sesión cerrada con éxito');
                window.location.href = '/';
            },
            error: function(xhr, status, error) {
                console.error('Error al cerrar sesión:', xhr, status, error);
            }
        });
    });
});
