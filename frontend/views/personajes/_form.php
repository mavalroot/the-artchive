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
        <label class="control-label">
            Fecha de nacimiento
            <?= DatePicker::widget([
                'model' => $model,
                'attribute' => 'fecha_nac',
                'options' => ['placeholder' => 'Enter birth date ...'],
                'pluginOptions' => [
                    'autoclose'=>true
                ]
            ]); ?>
        </label>
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
