<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personajes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= $form->field($model, 'fecha_nac')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Elija fecha de nacimiento...'],
            'pluginOptions' => [
                'autoclose'=> true
            ]
        ]); ?>
    </div>

    <?= $form->field($model, 'historia')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'personalidad')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'apariencia')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hechos_destacables')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
