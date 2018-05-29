<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Reportes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estandar-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->widget(Select2::classname(), [
        'data' => $model->getTipos(),
        'options' => ['placeholder' => Yii::t('frontend', 'Buscar al escribir...')],
    ]); ?>

    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
