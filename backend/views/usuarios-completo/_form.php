<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-completo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aficiones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tematica_favorita')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plataforma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagina_web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seguidores')->textInput() ?>

    <?= $form->field($model, 'siguiendo')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
