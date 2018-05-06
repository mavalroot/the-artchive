<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ActividadRecienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividad-reciente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-sm-6">
        <?= $form->field($model, 'creator') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'mensaje') ?>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
