$(function() {
    $(document).on('click', '.deleteTweet', function () {
        var tweet_id = $(this).data('tweet');
        $.post('http://coe.dev/123/projects/xxx/reTwitter/core/ajax/deleteTweet.php', {showPopup:tweet_id}, function (data) {
            $('.popupTweet').html(data);
        })
    });

    $(document).on('click', '.deleteComment', function () {
        var commentID = $(this).data('comment');
        var tweet_id = $(this).data('tweet');

        $.post('http://coe.dev/123/projects/xxx/reTwitter/core/ajax/deleteComment.php', {deleteComment:commentID}, function () {
            $.post('http://coe.dev/123/projects/xxx/reTwitter/core/ajax/popuptweets.php', {showpopup:tweet_id}, function (data) {
                $('.popupTweet').html(data);
                $('.tweet-show-popup-box-cut').click(function() {
                    $('.tweet-show-popup-wrap').hide();
                });
            });
        })
    })
});