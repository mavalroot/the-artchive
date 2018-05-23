reloadAlerts();

window.setInterval(function(){
  if ($('span.num-alerts-notis').length) {
    reloadAlerts();
  }
}, 10000);

function reloadAlerts() {
    $.getJSON('/usuarios-completo/numalerts', function(data) {
        if (data != $('span.num-alerts-notis').text()) {
          $('span.num-alerts-notis').empty();
          $('span.num-alerts-notis').append(data.notis);
          $('span.num-alerts-notis').addClass('new-alert');
        }
    });
}
