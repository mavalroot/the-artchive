<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reportes */

$this->title = $model->referencia;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mis reportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-view">
    <?= $this->render('_view', [
        'model' => $model,
    ]) ?>
</div>
