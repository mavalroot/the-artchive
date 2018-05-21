<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivados */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="estandar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emisor_name')->textInput(['value' => (Yii::$app->request->get('username') ?: '')]) ?>

    <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
