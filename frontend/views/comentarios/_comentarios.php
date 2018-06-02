<?php
use yii\widgets\LinkPager;
use common\models\Comentarios;

?>
<?= LinkPager::widget([
    'pagination' => $pagination,
]);
?>
<div id="publicacion-comentarios">
    <h3><?= Yii::t('frontend', 'Comentarios') ?></h3>
    <?php foreach ($comentarios as $comentario) : ?>
        <?= $this->render('_comentario', [
            'comentario' => $comentario,
            'publicacion' => $publicacion,
            'respuesta' => false,
            ]) ?>
    <?php endforeach; ?>
</div>
<?= LinkPager::widget([
    'pagination' => $pagination,
]);
?>
<div id="nuevo-comentario">
    <h3><?= Yii::t('frontend', 'Publicar comentario') ?></h3>
    <div class="nuevo-comentario">
        <?= $this->render('_responder', [
            'model' => new Comentarios(),
            'publicacion' => $publicacion,
            'comentario' => false,
        ]) ?>
    </div>
</div>
