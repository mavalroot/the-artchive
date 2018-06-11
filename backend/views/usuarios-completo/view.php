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


    <h1>
        <?= Html::encode($this->title) ?>
    <?php if ($model->status == User::STATUS_ACTIVE) : ?>
        (Activo)
    <?php elseif ($model->status == User::STATUS_DELETED) : ?>
        (Eliminado)
    <?php elseif ($model->status == User::STATUS_WAITING) : ?>
        (Esperando confirmación)
    <?php elseif ($model->status == User::STATUS_BANNED) : ?>
        (Baneado)
    <?php endif; ?>
    </h1>

    <?= $this->render('_active', [
        'model' => $model,
        'reciente' => $reciente,
    ]) ?>
</div>
