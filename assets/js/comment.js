$(function () {
    $(document).on('click', '#postComment', function () {
        var comment = $('#commentField').val();
        var tweet_id = $('#commentField').data('tweet');

        if (comment !== "") {
            $.post('http://coe.dev/123/projects/xxx/reTwitter/core/ajax/comment.php', {comment:comment, tweet_id:tweet_id}, function (data) {
                $('#comments').html(data);
                $('#commentField').val("");
            });
        }
    })
});