$(function() {
    $('.search').keyup(function() {
        var search = $(this).val();
        $.post('http://coe.dev/123/projects/xxx/reTwitter/core/ajax/search.php', {search:search}, function(data) {

        })
    });
});