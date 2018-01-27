$(function() {
    var regex = /[#|@(\w+)$/ig;

    $(document).on('keyup', '.status', function () {
        var content = $.trim($(this).val());
        var text    = content.match(regex);
        var max     = 140;

        if (text != null) {
            var dataString = 'hashtag'+text;

            $.ajax({
                type: "POST",
                url: "http://coe.dev/123/projects/xxx/reTwitter/core/ajax/getHashtag.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    $('.hash-box ul').html(data);

                }
            })
        }
    });
});