<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\TiposRelaciones;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Relaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estandar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::hiddenInput('Relaciones[personaje_id]', $personaje->id) ?>

    <?= $form->field($model, 'tipo_relacion_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(TiposRelaciones::find()->all(), 'id', 'tipo'),
        'options' => ['placeholder' => 'Buscar al escribir...'],
    ]); ?>

    <div id="contenido-relacion">
        <?= Html::button('Relación con personaje existente', ['class' => 'btn btn-sm btn-primary']) ?>

        <?= Html::button('Relación con personaje no registrado', ['class' => 'btn btn-sm btn-primary']) ?>

        <?= $this->render('_existente', [
            'model' => $model,
            'form' => $form,
        ]) ?>

        <?= $this->render('_anonimo', [
            'model' => $model,
            'form' => $form,
        ]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
