$(document).ready(function () {
    $('#profileCreationForm').submit(function (e) {
        e.preventDefault(); // Evita el envío del formulario de la manera tradicional

        var formData = new FormData(this); // Crea un objeto FormData con los datos del formulario

        $.ajax({
            type: 'POST',
            url: '/api/profile/create',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF de Laravel
            },
            success: function (response) {
                // Si la operación es exitosa
                console.log(response);
                alert('Perfil creado con éxito!');
                window.location.href = '/dashboard'; // Redireccionar al dashboard
            },

            error: function (xhr, textStatus, errorThrown) {
                let errorHtml = '<div class="alert alert-danger opacity-50">';
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (key, error) {
                        if (Array.isArray(error)) {
                            error.forEach(function (message) {
                                errorHtml += '<p>' + message + '</p>';
                            });

                        } else {
                            errorHtml += '<p>' + error + '</p>';
                        }
                        console.log(error);
                    });
                }
                console.log("Estado HTTP: ", xhr.status);
                console.log("Texto del Estado: ", textStatus);
                console.log("Error lanzado: ", errorThrown);
                console.log("Respuesta completa: ", xhr.responseText);
                errorHtml += '</div>';
                $('#errorMessages').html(errorHtml);
            }
        });
    });
});
