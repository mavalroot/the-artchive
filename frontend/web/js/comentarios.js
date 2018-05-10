function publicar(url) {
    $('#nuevo-comentario').on('submit','form[name="nuevo-comentario"]', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post(url, $(this).serialize(), function(data) {
            $('#error').empty();
            if (data) {
                $('#error').append(data);
            } else {
                $("#publicacion-comentarios").load(location.href+" #publicacion-comentarios>*","");
                $("#toggle").load(location.href+" #toggle>*","");
                $("form[name='nuevo-comentario']").load(location.href+" form[name='nuevo-comentario']>*","");
            }
        });
    });
}
function responder(url) {
    $('#publicacion-comentarios').on('click','a[name="responder-comentario"]', function() {
        let ide = $(this).parent().children('input[name="id"]').val();
        $.post(url, {id: ide}, function(data) {
            $('form[name="nuevo-comentario"]').prepend(data);
        });
    });
}

function eliminar(url) {
    $('#publicacion-comentarios').on('click','a[name="borrar-comentario"]', function(e) {
        e.preventDefault();
        let ide = $(this).parent().children('input[name="id"]').val();
        $.post(url, {id: ide}, function(data) {
            if (data) {
                $("#publicacion-comentarios").load(location.href+" #publicacion-comentarios>*","");
            }
        });
    });
}

function limpiar() {
    $('#limpiar').on('click', function() {
        $('p[class="quote-respuesta"]').remove()
    });
}
