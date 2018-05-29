<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ReportesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reportes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'tipo')->widget(Select2::classname(), [
                'data' => $model->getTipos(),
                'options' => ['placeholder' => Yii::t('frontend', 'Buscar al escribir...')],
            ]); ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'creator') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'referencia') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'estado')->widget(Select2::classname(), [
                'data' => ['En revisión' => 'En revisión', 'Aceptada' => 'Aceptada', 'Rechazada' => 'Rechazada'],
                'options' => ['placeholder' => Yii::t('frontend', 'Buscar al escribir...')],
            ]); ?>
        </div>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Borrar'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
