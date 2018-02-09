$(function () {
    $(document).on('click', '#send', function () {
        var message = $('#msg').val();
        var get_id = $(this).data('user');
        $.post('http://coe.dev/123/projects/xxx/reTwitter/core/ajax/messages.php', {sendMessage:message, get_id:get_id}, function () {
            getMessages();
            $('#msg').val('');
        })
    });
});