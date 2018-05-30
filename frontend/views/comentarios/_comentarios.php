<?php
use yii\widgets\LinkPager;

?>
<h3><?= Yii::t('frontend', 'Comentarios') ?></h3>
<div id="publicacion-comentarios">
    <?php foreach ($comentarios as $comentario) : ?>
        <div class="comentario" id="com<?= $comentario->id ?>">
            <div class="comentario-head">
                <span class="username">
                    <?= $comentario->getUsername() ?> ha comentado:
                </span>
            </div>
            <div class="comentario-body">
                <div class="contenido">
                    <?php if ($comentario->isDeleted()) : ?>
                        <?= Yii::$app->formatter->asRaw($comentario->contenido); ?>
                    <?php else : ?>
                        <?= Yii::$app->formatter->asnText($comentario->contenido) ?>
                    <?php endif; ?>
                </div>
                <div class="time">
                    <?= Yii::$app->formatter->asRelativeTime($comentario->created_at) ?>
                </div>
            </div>
            <div class="comentario-botones">
                <input type="hidden" name="id" value="<?= $comentario->id ?>">
                <?= $comentario->getResponderButton() ?>
                <?= $comentario->getBorrarButton() ?>
                <?= $comentario->getMostrarRespuestasButton() ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?= LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>
</div>
<div id="nuevo-comentario">
    <h3><?= Yii::t('frontend', 'Publicar comentario') ?></h3>

    <form name="nuevo-comentario" method="post">
        <input type="hidden" name="publicacion_id" value="<?= $model->id ?>">
        <textarea name="contenido" class="form-control" rows="5" maxlength="250"></textarea>
        <input type="submit" class="btn btn-success" value="<?= Yii::t('frontend', 'Enviar')?>">
    </form>
    <p id="error" class="text-danger"></p>
</div>

<?php
$crear = Yii::$app->request->baseUrl . '/comentarios/create';
$responder = Yii::$app->request->baseUrl . '/comentarios/responder';
$eliminar = Yii::$app->request->baseUrl . '/comentarios/delete';

$js = <<< JS
publicar("$crear");
responder("$responder");
eliminar("$eliminar");
mostrarRespuestas()

$('#nuevo-comentario').on('click', 'textarea[name="contenido"]', function () {
    $('textarea[name="contenido"]').remainingCharacters({
        label: {
            tag: 'p',
            id: 'char-counter',
        },
    });
});
JS;

$this->registerJs($js);
