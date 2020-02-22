$(function () {
    let login = $('#login-button');
    let form = $('#login-form');
    let email = $('#login-email-input');
    let password = $('#login-password-input');

    login.on('click', function () {
        $.post(
            form.attr('action'),
            {
                'email': email.val(),
                'password': password.val(),
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            let json = JSON.parse(data);

            $('#register-close-button').click();

            if (json.error) {
                $('#login-panel-wrap').prepend(
                    '<div class="alert alert-danger alert-dismissible" role="alert">'
                    + json.error +
                    '<button type="button" class="close" data-dismiss="alert" id="register-close-button">&times;</button>' +
                    '</div>\n');
            } else {
                json.location ? location.replace(json.location) : 0;
            }
        }
    });
});