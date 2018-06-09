<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reportes */

$this->title = Yii::t('app', 'Responder reporte: ') . $model->referencia;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reportes Traducciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reportes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
