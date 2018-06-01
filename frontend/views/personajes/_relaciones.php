<?php
use yii\helpers\Html;

use yii\widgets\LinkPager;

?>

<h2><?= Yii::t('frontend', 'Relaciones') ?></h2>

<div class="relaciones-relacion">
    <?php if (!$relaciones) : ?>
        <?= Yii::t('frontend', 'No se ha creado ninguna relación.') ?>
    <?php endif; ?>
    <?php foreach ($relaciones as $relacion) : ?>
        <div class="relacion">
            <?= $relacion->relacion ?>:
            <?php if ($relacion->referencia) : ?>
                <?= Html::a(Yii::$app->formatter->asText($relacion->supj), ['personajes/view', 'id' => $relacion->supjid]) ?>
                <?php if ($relacion->getSolicitudes()->count() && !$relacion->aceptada) : ?>
                    <?= Yii::t('frontend', '(Pendiente de confirmación)') ?>
                <?php endif; ?>
            <?php else : ?>
                <?= Yii::$app->formatter->asText($relacion->nombre) ?>
            <?php endif; ?>
            <?php if ($model->isMine()) : ?>
                <?= $relacion->getDeleteButton() ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?= LinkPager::widget([
    'pagination' => $pagination,
]);
?>
</div>
