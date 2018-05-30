<?php
use yii\widgets\LinkPager;
use common\models\Comentarios;

?>
<h3><?= Yii::t('frontend', 'Comentarios') ?></h3>
<div id="publicacion-comentarios">
    <?php foreach ($comentarios as $comentario) : ?>
        <?= $this->render('_comentario', [
            'comentario' => $comentario,
            'publicacion' => $publicacion
            ]) ?>
    <?php endforeach; ?>
    <?= LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>
</div>
<div id="nuevo-comentario">
    <h3><?= Yii::t('frontend', 'Publicar comentario') ?></h3>

    <?= $this->render('_responder', [
        'model' => new Comentarios(),
        'publicacion' => $publicacion,
        'comentario' => false,
        ]) ?>
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
