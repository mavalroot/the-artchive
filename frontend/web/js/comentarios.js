function publicar(url) {
    $('#nuevo-comentario').on('submit','.nuevo-comentario > form', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post(url, $(this).serialize(), function(data) {
            if (data == true) {
                $("#publicacion-comentarios").load(location.href+" #publicacion-comentarios>*","");
                $("#nuevo-comentario > .nuevo-comentario").load(location.href+" #nuevo-comentario > .nuevo-comentario >*","");
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

        $.post('/comentarios/responder', {id: ide, publicacion: publi}, function (data) {
            if ($(comId).find('.respuesta').length) {
                $(comId).find('.respuesta').remove();
            }
            $(comId).children('.comentario-botones').after('<div class="respuesta">' + data + '</div>');
        });
    });
}

function publicarRespuesta(url) {
    $('#publicacion-comentarios').on('submit', '.comentario > .respuesta > form', function (e) {
        e.preventDefault();
        let that = $(this);
        $.post(url, $(this).serialize(), function(data) {
            if (data == 1) {
                $("#publicacion-comentarios").load(location.href+" #publicacion-comentarios>*","");
            } else {
                $(that).find('.error').empty();
                $(that).find('.error').append(data);
            }
        });
    });
}

function mostrarRespuestas() {
    $('#publicacion-comentarios').on('click', 'button[name="mostrar-respuestas"]', function() {
        let ide = $(this).parent().children('input[name="id"]').val();
        let comId = '#com' + ide;
        $.post('/comentarios/mostrar-respuestas', {id: ide}, function(data) {
            if ($(comId).find('.comentarios-respuestas').length) {
                $('.comentarios-respuestas').remove();
            }
            if ($(comId).find('.no-respuestas').length) {
                $('.no-respuestas').remove();
            }
            if ($(comId).find('button[name="ocultar-respuestas"]').length) {
                $(comId).find('button[name="ocultar-respuestas"]').remove();
            }
            $(comId).append(data);
            $(comId).find('button[name="mostrar-respuestas"]').after('<button type="button" name="ocultar-respuestas" class="btn btn-link especial"><i class="fas fa-eye-slash"></i></button>')
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
                    let borrado = '<div class="contenido-new"><em class="text-danger">---</em></div>';
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
