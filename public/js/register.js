$(function () {
    let register = $('#register-button');
    let form = $('#register-form');
    let email = $('#register-email-input');
    let username = $('#register-username-input');
    let password = $('#register-password-input');
    let confirm = $('#register-confirm-input');

    register.on('click', function () {
        $.post(
            form.attr('action'),
            {
                'email': email.val(),
                'username': username.val(),
                'password': password.val(),
                'confirm': confirm.val()
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            let json = JSON.parse(data);
            $('#register-close-button').click();

            if (json.err) {
                $('#registerMenuWrap').prepend(
                    '<div class="alert alert-danger alert-dismissible" role="alert">'
                    + json.err +
                    '<button type="button" class="close" data-dismiss="alert" id="register-close-button">&times;</button>' +
                    '</div>\n');
            } else {
                location.replace(json.location);
            }
        }
    });
});