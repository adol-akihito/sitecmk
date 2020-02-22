$(function () {
    let forms = $('.homeCommentForm');
    let getCommentsInput = $('.homeCommentSubmit');
    let post;
    let post_id;
    let childrenForms;

    forms.each(function () {
        $(this).children('[type = button]').on('click', function () {
            $.post(
                $(this).parent().attr("action"),
                {
                    comment: $(this).siblings().val(),
                    parent_id: 0
                },
                onAjaxSuccess
            );

            function onAjaxSuccess(data) {
                let json = JSON.parse(data);
                let post = $("#" + json.post_id);
                let commentCollection = post.children('.homeCommentDiv');
                let username = $('<h5></h5>').text(json.author + ':');
                let fullDate = $('<p class="addedDate"></p>').text(json.now_date);
                let text = $('<p></p>').text(json.comment);

                commentCollection.last().append(username, fullDate, text, '<br>');
                $('input[type = text]').val('');
            }

        })
    });

    getCommentsInput.each(function () {
        $(this).on('click', function () {
            post = $(this).parent().parent();
            post_id = post.attr('id');
            $.post(
                $(this).parent().attr('action'),
                {},
                onAjaxSuccess
            );

            function onAjaxSuccess(data) {

                post.children('#homeCommentDiv').css('display', 'block');
                post.children('#displayCommentsButton' + post_id).css('display', 'none');
                post.children('.homeCommentDiv').html(data);
                childrenForms = $(".homeChildCommentSubmit");

            }
        })
    });

    $('.summernote').summernote({
        height: 350,
        minHeight: null,
        maxHeight: null
    });

});

