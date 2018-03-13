<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivadosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensajes-privados-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'emisor_id') ?>

    <?= $form->field($model, 'receptor_id') ?>

    <?= $form->field($model, 'asunto') ?>

    <?= $form->field($model, 'contenido') ?>

    <?php // echo $form->field($model, 'visto')->checkbox() ?>

    <?php // echo $form->field($model, 'leido')->checkbox() ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
