<?php

use yii\helpers\Html;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($model->status == User::STATUS_ACTIVE): ?>
        <?= $this->render('_active', [
            'model' => $model,
            'reciente' => $reciente,
        ]) ?>
    <?php elseif ($model->status == User::STATUS_DELETED): ?>
        <h2>Este usuario ha sido eliminado.</h2>
    <?php elseif ($model->status == User::STATUS_WAITING): ?>
        <h2>Este usuario espera confirmación.</h2>
    <?php elseif ($model->status == User::STATUS_BANNED): ?>
        <h2>Este usuario está baneado.</h2>
    <?php endif; ?>

</div>
