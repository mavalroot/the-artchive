<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<h3><?= Yii::t('frontend', 'Comentarios') ?></h3>
<div id="publicacion-comentarios">
    <?php foreach ($comentarios as $comentario) : ?>
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
                    <a href="#nuevo-comentario" class="btn btn-xs btn-info" name="responder-comentario"><?= Yii::t('frontend', 'Responder') ?></a>
                    <?php if ($comentario->isMine() && !$comentario->isDeleted()) : ?>
                        <a href="#" name="borrar-comentario" class="btn btn-xs btn-danger"><?= Yii::t('frontend', 'Borrar') ?></a>
                    <?php endif; ?>
            </div>
            <div class="comentario-body">
                <div class="quote">
                    <?php if ($comentario->quoted > 0) : ?>
                        <?= $comentario->getRespuestaUrl() ?>
                    <?php endif; ?>
                </div>
                <div class="contenido">
                    <?php if ($comentario->isDeleted()) : ?>
                        <?= Yii::$app->formatter->asRaw($comentario->contenido); ?>
                    <?php else : ?>
                        <?= Yii::$app->formatter->asnText($comentario->contenido) ?>
                    <?php endif; ?>
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
