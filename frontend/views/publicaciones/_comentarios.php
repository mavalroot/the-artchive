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
                <input class="btn btn-sm" type="button" name="responder-comentario" value="Responder">
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
        <p id="error" class="text-danger"></p>
        <input type="submit" class="btn btn-success" value="Enviar">
    </form>
</div>

<?php
$url = Yii::$app->request->baseUrl. '/comentarios/create';

$js = <<< JS
function publicar() {
    $('#nuevo-comentario').on('submit','form[name="nuevo-comentario"]', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post("$url", $(this).serialize(), function(data) {
            if (data) {
                $('#error').empty();
                if (data !== 'true') {
                    $('#error').append(data);
                }
                $("#publicacion-comentarios").load(location.href+" #publicacion-comentarios>*","");
            }
        });
    });
}

publicar();
JS;

$this->registerJs($js);
