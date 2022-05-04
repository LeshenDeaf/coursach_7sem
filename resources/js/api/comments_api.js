const Api = require('./api');

class CommentsApi extends Api {
    constructor () {
        super(window.location.href + '/comments');
        console.log(this.url);
    }

    successCB (response) {
        $('.comments').append(HTMLGenerator.makeCommentDiv(response));
        $('.comment_form .comment_input').val('');
    }
}

class HTMLGenerator
{
    static makeCommentDiv (response) {
        let replyTo = response.parent.id !== null
            ? `<span class="comment_reply"
                      value="${response.parent.id}"
                >${response.parent.user_name}</span>,`
            : '';

        return `<div class="comment border-b border-gray-100 py-1">
            <div class="text-sm font-bold select-none mb-2">
                                    <span class="hover:text-blue-400 transition-all">
                                        ${response.user.name}
                                    </span>
                <span class="ml-6 font-medium">0 minutes ago</span>

            </div>
            <div class="comment_text">
                ${replyTo}
                ${response.body}
            </div>
            <div class="text-sm">
                <span class="reply">Reply</span>
            </div>
            <input type="hidden" name="id" value="${response.id}">
                <div class="reply_form">
                </div>
        </div>`
    }

    static makeForm() {
        return `<div class="comment_form">
                    <textarea class="comment_input"
                              name="comment"
                              placeholder="Your comment..."
                    ></textarea>

                    <button class="submit_comment"
                            type="button"
                            disabled
                    >Submit</button>

                    <button class="cancel_comment"
                            type="button"
                    >Cancel</button>
                </div>`;
    }
}

const commentsApi = new CommentsApi();

$(document).on('input', '.comment_form .comment_input', function () {
    const val = $(this).val().trim();

    if (!val) {
        $(this).parent().find('.submit_comment').prop('disabled', true);
        return;
    }

    $(this).parent().find('.submit_comment').prop('disabled', false);
})

$(document).on('click', '.comment_form .submit_comment', function () {
    if ($(this).prop('disabled')) {
        return;
    }

    const fd = new FormData();

    fd.append('body', $(this).parent().find('.comment_input').eq(0).val().trim());

    let parentComment = $(this).parents('.comment').eq(0).find('input[name="id"]');
    if (parentComment.length > 0) {
        fd.append('parent_id', parentComment.val())
    } else {
        fd.append('parent_id', '')
    }

    commentsApi.store(commentsApi.successCB, console.log, fd, false);

    if ($(this).parents('.comment').length > 0) {
        $(this).parents('.comment_form').eq(0).remove();
    }
    console.log('enabled');
})

$(document).on('click', '.comment .reply', function () {
    $(this).parents('.comment').eq(0).find('.reply_form').html(HTMLGenerator.makeForm());
})

$(document).on('click', '.cancel_comment', function () {
    $(this).parents('.comment_form').eq(0).remove();
})

$(document).on('click', '.comment_reply', function () {
    const element = $(document).find(`input[name="id"][value="${$(this).attr('value')}"]`).parents('.comment').eq(0);

    $('html, body').stop().animate({
        'scrollTop': element.offset().top
    }, 300, 'swing', function () {
        element.addClass('highlighted');
        window.setTimeout(function(){
            element.removeClass('highlighted');
        }, 3000); //<-- Delay in milliseconds
    });
})

module.exports = commentsApi;
