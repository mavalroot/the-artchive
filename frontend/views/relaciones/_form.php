<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\TiposRelaciones;

/* @var $this yii\web\View */
/* @var $model common\models\Relaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::hiddenInput('Relaciones[personaje_id]', $personaje->id) ?>

    <?= $form->field($model, 'tipo_relacion_id')->dropDownList(ArrayHelper::map(TiposRelaciones::find()->all(), 'id', 'tipo'), ['prompt'=>'']) ?>

    <div id="contenido-relacion">
        <?= Html::button('Relación con personaje existente', ['class' => 'btn btn-sm btn-primary']) ?>

        <?= Html::button('Relación con personaje no registrado', ['class' => 'btn btn-sm btn-primary']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
