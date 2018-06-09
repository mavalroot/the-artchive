<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('frontend', 'Resetear contraseña');
?>
<div class="container">
    <div class="default-form">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><?= Yii::t('frontend', 'Por favor, elige una nueva contraseña:') ?></p>

        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

            <div class="form-group text-center">
                <?= Html::submitButton(Yii::t('frontend', 'Guardar'), ['class' => 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
