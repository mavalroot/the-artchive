<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PersonajesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personajes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'usuario_id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'fecha_nac') ?>

    <?= $form->field($model, 'historia') ?>

    <?php // echo $form->field($model, 'personalidad') ?>

    <?php // echo $form->field($model, 'apariencia') ?>

    <?php // echo $form->field($model, 'hechos_destacables') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
