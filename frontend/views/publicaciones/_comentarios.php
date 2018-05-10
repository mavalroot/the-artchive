<?php use yii\widgets\LinkPager;

?>
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
    <?= LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>
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
$crear = Yii::$app->request->baseUrl. '/comentarios/create';
$responder = Yii::$app->request->baseUrl. '/comentarios/responder';

$js = <<< JS
publicar("$crear");
responder("$responder");
JS;

$this->registerJs($js);
