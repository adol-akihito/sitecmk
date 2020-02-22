$(function () {
    let comment_form = $('#form-review');
    const action = comment_form.attr('action');
    let input = $('#input-review');
    let parent_user;
    let submit_button = $('#button-review');
    let commentsShowButton = $('#comments_show');
    let commentsShowForm = $('#show-comments-form');
    let commentsContainer = $('#comments_container');


    commentsShowButton.on('click', function () {
        $.post(
            commentsShowForm.attr('action'),
            {},
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            let json = JSON.parse(data);

            commentsShowForm.css('display', 'none');
            comment_form.css('display', 'block');

            renderComment(json);
        }
    });

    function renderComment(json, parent_id = 0) {
        let newComment;
        let addedComment;
        for (let key in json) {
            newComment =
                '<div class="col-sm-12">' + json[key].date_added +
                ' <b><a id = "comment_' + json[key].id + '">@' + json[key].author +
                '</a></b>: ' + json[key].text +
                '</div>';

            if (parent_id === 0) {
                addedComment = commentsContainer.prepend(newComment);
            } else {
                let parentComment = $('#comment_' + parent_id).parent().parent();
                parentComment.append(newComment);
            }

            if (json[key].answers.length) {
                renderComment(json[key].answers, json[key].id);
            }
        }

        let hrefs = $('.col-sm-12').children('b');

        hrefs.on('click', reply);
    }

    // Add Comment //
    submit_button.on('click', function () {
        if ((input.val().indexOf(parent_user) === -1) || (input.val().indexOf('@')) !== 0) {
            comment_form.attr('action', action);
        } else {
            let input_str = input.val();
            input.val(input_str.replace(' ', ', '));
        }

        $.post(
            comment_form.attr('action'),
            {
                text: input.val()
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            let json = JSON.parse(data);
            if (json.error) {
                $('#content').prepend(
                    '<div class="alert alert-danger alert-dismissible">'
                    + json.error +
                    '<button id="error-alert-close" type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '</div>')
            } else {
                $('#error-alert-close').click();
                let addedComment;
                let newComment =
                    '<div class="col-sm-12 com-div">' + json.date_added +
                    ' <b><a id = "comment_' + json.comment_id +
                    '">@' + json.author +
                    '</a></b>: ' + json.text +
                    '</div>';

                addedComment = appendComment(json.parent_id, newComment);
                addedComment.on('click', reply);
                input.val('');
            }
        }
    });

    function reply() {
        parent_user = $(this).children('a').text();
        input.val(parent_user + ' ');

        comment_form.attr('action', action + '&' + 'parent_id=' + (+$(this).children('a').attr('id').match(/\d+/)[0]));
    }

    function appendComment(parent_id = 0, newComment) {
        if (parent_id) {
            return $('#comment_' + parent_id).parent().parent().append(newComment).children().last().children('b');
        } else {
            return commentsContainer.first().prepend(newComment).children().first().children('b');
        }
    }

});