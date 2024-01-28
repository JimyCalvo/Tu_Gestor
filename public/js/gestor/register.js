$(document).ready(function() {
    $('#registerForm').submit(function(e) {
        e.preventDefault();

        $('#errorMessages').html('');

        var formData = {
            username: $('#username').val(),
            name: $('#name').val(),
            last_name: $('#last_name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
        };


        $.ajax({
            type: 'POST',
            url: '/api/register',
            data: formData,
            dataType: 'json',
            success: function(data) {
                if (data.redirectUrl) {
                    window.location.href = data.redirectUrl;
                }else{
                    window.location.href = '/';
                }
            },
            error: function(data) {
                var errors = data.responseJSON.errors;
                var errorHtml = '<ul>';

                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });

                errorHtml += '</ul></div>';
                $('#errorMessages').html(errorHtml);
                $('#errorModal').modal('show');
            }
        });
    });
});
