<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivados */

$this->title = 'Update Mensajes Privados: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Mensajes Privados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mensajes-privados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
