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
    $('#change-language button').on('click', function() {
      let value = $(this).val();
      $.post('/site/switch-language', {language: value}, function(data) {
        location.reload();
      });
    });
});
