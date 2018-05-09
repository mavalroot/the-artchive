<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comentarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usuario_id')->textInput() ?>

    <?= $form->field($model, 'publicacion_id')->textInput() ?>
    <?= $form->field($model, 'comentario_id')->textInput() ?>

    <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
