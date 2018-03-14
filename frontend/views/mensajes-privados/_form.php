<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensajes-privados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::label('Usuario', 'emisor_name') ?>
    <?= Html::textInput('emisor_name', (Yii::$app->request->get('username') ?: ''), ['class' => 'form-control']) ?>

    <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
