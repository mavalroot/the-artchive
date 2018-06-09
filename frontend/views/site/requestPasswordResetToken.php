<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('frontend', 'Recuperar contraseña');
?>
<div class="container">
    <div class="default-form">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Yii::t('frontend', 'Por favor, introduce tu email. Se enviará un link para resetear la contraseña.') ?>
        </p>

        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group text-center">
                <?= Html::submitButton(Yii::t('frontend', 'Enviar'), ['class' => 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
