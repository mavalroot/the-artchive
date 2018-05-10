$(document).ready(function() {
    $('#toggle').on('click', function() {
        $(this).next().slideToggle();
    });
});
