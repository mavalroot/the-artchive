<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = 'Update Usuarios Completo: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios Completos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuarios-completo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
