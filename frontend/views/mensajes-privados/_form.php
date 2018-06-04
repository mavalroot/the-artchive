<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\User;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estandar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'receptor_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('frontend', 'Buscar al escribir...')],
    ]); ?>

    <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
