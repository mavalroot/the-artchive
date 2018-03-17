<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosDatos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-datos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aficiones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tematica_favorita')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plataforma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagina_web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <h1>Delete Account</h1>
    <p>
        Mensaje de advertencia.
    </p>
    <?= Html::a('Delete account', ['site/delete'], ['class' => 'btn btn-danger']); ?>

</div>
