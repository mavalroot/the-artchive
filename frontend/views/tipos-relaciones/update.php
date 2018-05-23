<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TiposRelaciones */

$this->title = 'Update Tipos Relaciones: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipos Relaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipos-relaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
