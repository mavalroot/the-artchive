$(document).ready(function() {
    $('body').on('click', '#toggle', function() {
        $(this).next().slideToggle();
    });
});
