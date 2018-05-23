window.setInterval(function(){
  if ($('span.num-alerts-notis').length) {
    reloadAlerts();
  }
}, 10000);

function reloadAlerts() {
    $.getJSON('/usuarios-completo/numalerts', function(data) {
        refresh($('span.num-alerts-notis'), data.notis);
        refresh($('span.num-alerts-mp'), data.mps);
    });
}

function refresh(selector, data) {
  if (data != $(selector).text()) {
    selector.empty();
    $(selector).append(data);
    $(selector).addClass('new-alert');
  }
}

$(document).ready(function() {
    $('#existente').on('click', function() {
        alert('hello');
        $.get('/relaciones/_existente.php', {}, function (data) {
            $(data).appendTo('#contenido-relacion');
        });
    });
});
