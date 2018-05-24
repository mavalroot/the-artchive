<?php
use yii\helpers\Html;

?>

<h2>Relaciones</h2>

<?php foreach ($relaciones as $relacion): ?>
    <?= $relacion->relacion ?>:
    <?= Html::a($relacion->supj, ['personajes/view', 'id' => $relacion->supjid]) ?>
    <?php if (!$relacion->aceptada): ?>
        (Pendiente de confirmación)
    <?php endif; ?>
<?php endforeach; ?>
