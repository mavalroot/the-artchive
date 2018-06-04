<?php
use common\models\UsuariosCompleto;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */

$usuario = UsuariosCompleto::findOne(['id' => $model->usuario_id]);
$owner = $usuario->username;

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Personajes de') . ' ' . $owner, 'url' => ['index', 'username' => $owner]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($usuario->isApto()): ?>

<div class="personajes-view">
    <?= $this->render('_view', [
        'model' => $model,
        'usuario' => $usuario,
    ])?>

    <?= $this->render('_relaciones', [
        'model' => $model,
        'relaciones' => $relaciones,
        'pagination' => $pagination,
    ]) ?>

</div>

<?php

$js = <<< JS
actionButton('/relaciones/delete', 'delete-relation', '.relaciones-relacion', '.relaciones-relacion');
JS;

$this->registerJs($js);
?>
<?php else: ?>
    <h2>No puedes ver este personaje.</h2>
<?php endif; ?>
