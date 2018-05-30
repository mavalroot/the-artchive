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
    $('#publicacion-comentarios').on('click','button[name="responder-comentario"]', function() {
        let ide = $(this).parent().children('input[name="id"]').val();
        let comId = '#com' + ide;
        $(comId).append('<div id="respuesta-comentario"><textarea></textarea><button type="button" name="publicar-respuesta">Responder</button></div>');
        // $.post(url, {id: ide}, function(data) {
        //     if (data) {
        //         $('form[name="nuevo-comentario"]').prepend(data);
        //     }
        // });
    });
}

function publicarRespuesta() {
    $('#publicacion-comentarios').on('click')
}

function mostrarRespuestas() {
    $('#publicacion-comentarios').on('click', 'button[name="mostrar-respuestas"]', function() {
        let ide = $(this).parent().children('input[name="id"]').val();
        let comId = '#com' + ide;
        $.post('/comentarios/mostrar-respuestas', {id: ide}, function(data) {
            $(comId).children('.comentario-botones').after(data);
        });
    });
}

function eliminar(url) {
    $('#publicacion-comentarios').on('click','button[name="borrar-comentario"]', function(e) {
        e.preventDefault();
        let confirmar = confirm('¿Seguro?');
        if (confirmar) {
            let ide = $(this).parent().children('input[name="id"]').val();
            $.post(url, {id: ide}, function(data) {
                if (data) {
                    $("#publicacion-comentarios").load(location.href+" #publicacion-comentarios>*","");
                }
            });
        }
    });
}

function limpiar() {
    $('#limpiar').on('click', function() {
        $('p[class="quote-respuesta"]').remove()
    });
}
