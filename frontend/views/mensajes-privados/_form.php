<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensajes-privados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emisor_id')->textInput() ?>

    <?= $form->field($model, 'receptor_id')->textInput() ?>

    <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'visto')->checkbox() ?>

    <?= $form->field($model, 'leido')->checkbox() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
