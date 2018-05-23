<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Relaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'personaje_id')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencia')->textInput() ?>

    <?= $form->field($model, 'tipo_relacion_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
