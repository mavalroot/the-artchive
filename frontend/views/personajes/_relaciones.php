<?php
use yii\helpers\Html;

?>

<h2>Relaciones</h2>

<?php foreach ($relaciones as $relacion): ?>
    <div class="relaciones-relacion">
        <?= $relacion->relacion ?>:
        <?php if ($relacion->referencia): ?>
            <?= Html::a(Yii::$app->formatter->asText($relacion->supj), ['personajes/view', 'id' => $relacion->supjid]) ?>
            <?php if (!$relacion->aceptada): ?>
                (Pendiente de confirmación)
            <?php endif; ?>
        <?php else: ?>
            <?= Yii::$app->formatter->asText($relacion->nombre) ?>
        <?php endif; ?>
        <?php if ($model->isMine()): ?>
            <?= Html::a('Borrar', ['/relaciones/delete', 'id' => $relacion->id], [
                'class' => 'btn btn-sm btn-danger',
                'data' => [
                    'confirm' => '¿Seguro que desea borrar la relación? No podrá ser recuperada.',
                    'method' => 'post',
                ],
            ]); ?>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
