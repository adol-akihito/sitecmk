$(function () {
    let div_collection = $('.MyDIVs');

    div_collection.on('click', function () {
        let enotherDiv = $(this).siblings();

        if ($(this).css('display') === 'block') {
            $(this).css('display', 'none');
            enotherDiv.css('display', 'block');
        } else {
            $(this).css('display', 'block');
            enotherDiv.css('display', 'none');
        }
    });
});