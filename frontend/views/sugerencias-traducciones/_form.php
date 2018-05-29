<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SugerenciasTraducciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estandar-form">
    <p>
        <?= Yii::t('frontend/long', 'Para mejorar la calidad del servicio de The Artchive, puedes sugerir traducciones de parte del contenido de la aplicación que creas que no está bien redactado.<br />
        Por favor, si vas a hacer una sugerencia aporta una traducción para hacer la corrección.') ?>
    </p>
    <?php $form = ActiveForm::begin(); ?>

    <p>
        <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>
        <small><?= Yii::t('frontend/long', 'Link de la zona o descripción breve.') ?></small>
    </p>
    <p>
        <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>
        <small><?= Yii::t('frontend/long', 'Contenido de la sugerencia, incluir traducción si lo precisa.') ?></small>
    </p>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
