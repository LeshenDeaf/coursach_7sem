function sendMarkRequest(id = null) {
    return $.ajax("/mark-as-read", {
        method: 'POST',
        data: {
            "id": id
        }
    });
}

$(function () {
    $('.mark-as-read').click(function () {
        const request = sendMarkRequest($(this).data('id'));

        request.done(() => {
            $(this).parents('.notification').remove();
        });

        $('.notifications_count').text($('.notifications_count').text() - 1);
    });
    $('#mark-all').click(function () {
        const request = sendMarkRequest();

        request.done(() => {
            $('.notification').remove();
        })
    });
});
