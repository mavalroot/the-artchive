<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reportes */

$this->title = Yii::t('app', 'Crear nueva sugerencia de traducción');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mis reportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estandar-action">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
