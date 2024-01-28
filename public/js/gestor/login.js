$(document).ready(function () {
    $('#ajaxLoginForm').on('submit', function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $('#errorMessages').empty();

        $.ajax({
            url: '/api/login',
            type: 'POST',
            data: formData,
            success: function (response) {
                localStorage.setItem('token', response.access_token);
                if (response.redirectUrl) {
                    window.location.href = response.redirectUrl;
                }
            },
            error: function (xhr) {
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
                    });
                }
                errorHtml += '</div>';
                $('#errorMessages').html(errorHtml);
            }
        });
    });
});
