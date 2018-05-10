<div id="toggle">
    <h3>Mostar/Ocultar <?= count($model->getComentarios()->all()) ?> comentarios</h3>
</div>
<div id="publicacion-comentarios">
    <?php foreach ($comentarios as $comentario): ?>
        <div class="comentario" id="com<?= $comentario->id ?>">
            <div class="comentario-head">
                <span class="permalink-username">
                    <?= $comentario->getPermalink() ?> <?= $comentario->getUsername() ?>
                </span>
                <small>
                    [<?= Yii::$app->formatter->asDateTime($comentario->created_at) ?>]
                </small>
            </div>
            <div class="comentario-botones">
                    <input type="hidden" name="id" value="<?= $comentario->id ?>">
                    <a href="#nuevo-comentario" class="btn btn-sm" name="responder-comentario">Responder</a>
                <!-- Editar / Borrar / Responder -->
            </div>
            <div class="comentario-body">
                <div class="quote">
                    <?= $comentario->getRespuestaUrl() ?>
                </div>
                <div class="contenido">
                    <?= Yii::$app->formatter->asnText($comentario->contenido) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div id="nuevo-comentario">
    <h3>Publicar comentario</h3>
    <form name="nuevo-comentario" method="post">
        <input type="hidden" name="publicacion_id" value="<?= $model->id ?>">
        <textarea name="contenido" class="form-control" rows="5"></textarea>
        <input type="submit" class="btn btn-success" value="Enviar">
    </form>
    <p id="error" class="text-danger"></p>
</div>

<?php
$url = Yii::$app->request->baseUrl. '/comentarios/create';

$js = <<< JS
function publicar() {
    $('#nuevo-comentario').on('submit','form[name="nuevo-comentario"]', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post("$url", $(this).serialize(), function(data) {
            $('#error').empty();
            if (data !== 'true') {
                $('#error').append(data);
            }
            $("#publicacion-comentarios").load(location.href+" #publicacion-comentarios>*","");
            $("#toggle").load(location.href+" #toggle>*","");
            $("form[name='nuevo-comentario']").load(location.href+" form[name='nuevo-comentario']>*","");
        });
    });
}

publicar();
JS;

$this->registerJs($js);

$url = Yii::$app->request->baseUrl. '/comentarios/responder';
$js2 = <<< JS
$('#publicacion-comentarios').on('click','a[name="responder-comentario"]', function() {
    let ide = $(this).parent().children('input[name="id"]').val();
    $.post("$url", {id: ide}, function(data) {
        $('form[name="nuevo-comentario"]').prepend(data);
    });
});
JS;

$this->registerJs($js2);
