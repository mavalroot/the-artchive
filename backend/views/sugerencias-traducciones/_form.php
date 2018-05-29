<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\SugerenciasTraducciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sugerencias-traducciones-form">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'referencia',
            'contenido:ntext',
            'estado',
            'created_at:datetime',
        ],
    ]) ?>
    <h3>Actualizar</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estado')->widget(Select2::classname(), [
        'data' => ['En revisión' => 'En revisión', 'Aceptada' => 'Aceptar', 'Rechazada' => 'Rechazar'],
        'options' => ['placeholder' => Yii::t('frontend', 'Buscar al escribir...')],
    ]); ?>

    <?= $form->field($model, 'respuesta')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
