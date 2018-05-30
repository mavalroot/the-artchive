function publicar(url) {
    $('#nuevo-comentario').on('submit','.respuesta > form', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post(url, $(this).serialize(), function(data) {
            if (data == true) {
                $("#publicacion-comentarios").load(location.href+" #publicacion-comentarios>*","");
                $("#nuevo-comentario > .respuesta").load(location.href+" #nuevo-comentario > .respuesta >*","");
            } else {
                $(that).find('.error').empty();
                $(that).find('.error').append(data);
            }
        });
    });
}

function responder() {
    $('#publicacion-comentarios').on('click','button[name="responder-comentario"]', function() {
        let ide = $(this).parent().children('input[name="id"]').val();
        let publi = $(this).parent().children('input[name="publicacion"]').val();
        let comId = '#com' + ide;

        $.post('/comentarios/responder')

        $(comId).append('<div id="respuesta-comentario"><textarea></textarea><button type="button" name="publicar-respuesta">Responder</button></div>');
        // $.post(url, {id: ide}, function(data) {
        //     if (data) {
        //         $('form[name="nuevo-comentario"]').prepend(data);
        //     }
        // });
    });
}

function publicarRespuesta() {
    $('#publicacion-comentarios').on('click', '.respuesta-comentario > .publicar-respuesta', function () {

    });
}

function mostrarRespuestas() {
    $('#publicacion-comentarios').on('click', 'button[name="mostrar-respuestas"]', function() {
        let ide = $(this).parent().children('input[name="id"]').val();
        let comId = '#com' + ide;
        $.post('/comentarios/mostrar-respuestas', {id: ide}, function(data) {
            if ($('.comentarios-respuestas').length) {
                $('.comentarios-respuestas').remove();
            }
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
            let comId = '#com' + ide;
            $.post(url, {id: ide}, function(data) {
                if (data) {
                    let borrado = '<div class="contenido-new"><em class="text-danger">Este comentario ha sido borrado por <strong>su autor</strong>.</em></div>';
                    $(comId).find('.contenido').replaceWith(borrado);
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
