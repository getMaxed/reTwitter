$(function() {
    var win = $(window);
    var offset = 10;

    win.scroll(function () {
        if ($(document).height() <= (win.height() + win.scrollTop())) {
            offset += 10;
            $('#loader').show();
            $.post('http://coe.dev/123/projects/xxx/reTwitter/core/ajax/fetchPosts.php', {fetchPosts:offset}, function (data) {
                $('.tweets').html(data);
                $('#loader').hide();
            });
        }
    });
});