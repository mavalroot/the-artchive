<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosDatos */

$this->title = 'Modificar perfil de: ' . $model->getName();
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => $model->getMiPerfil()];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="usuarios-datos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <h1>Delete Account</h1>
    <p>
        Mensaje de advertencia.
    </p>
    <?= Html::a('Delete account', ['site/delete-account'], ['class' => 'btn btn-danger']); ?>

</div>
