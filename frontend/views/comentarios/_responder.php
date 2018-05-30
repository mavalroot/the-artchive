<?php
use yii\helpers\Html;

use yii\widgets\ActiveForm;

?>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'publicacion_id')->hiddenInput(['value'=> $publicacion])->label(false); ?>

    <?php if ($comentario): ?>
        <?= $form->field($model, 'comentario_id')->hiddenInput(['value'=> $comentario])->label(false); ?>
    <?php endif; ?>

    <?= $form->field($model, 'contenido')->textarea([
        'class' => 'form-control',
        'maxlength' => 250,
        ])->label(false) ?>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('frontend', 'Enviar'), ['class' => 'btn btn-success']) ?>
    </div>

    <div class="error">

    </div>

    <?php ActiveForm::end(); ?>
