$(document).ready(function () {
  var num = $('span.num-alerts');
});

window.setInterval(function(){
  if (num != $('span.num-alerts').text()) {
    reloadAlerts();
  }
}, 1000);

function reloadAlerts() {
    $.post('/usuarios-completo/numalerts', {}, function(data) {
        if (data != $('span.num-alerts').text()) {
          $('span.num-alerts').empty();
          $('span.num-alerts').append(data);
          $('span.num-alerts').addClass('new-alert');
          num = data;
        }
    });
}
