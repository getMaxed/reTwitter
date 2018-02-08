$(function () {
    $(document).on('click', '#messagePopup', function () {
        var getMessages = 1;
        $.post("http://coe.dev/123/projects/xxx/reTwitter/core/ajax/messages.php", {showMessage:getMessages}, function (data) {
            $('.popupTweet').html(data);
        })
    });
});