<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PersonajesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personajes-search">
    <h2>+ Buscar:</h2>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'creator') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'nombre') ?>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
