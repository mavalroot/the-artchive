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
            <input type="button" class="btn btn-xs btn-danger" name="" value="Borrar">
        <?php endif; ?>
    </div>
<?php endforeach; ?>
