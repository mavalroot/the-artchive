<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosDatos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estandar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aficiones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tematica_favorita')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagina_web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->fileInput()->label('Avatar') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
