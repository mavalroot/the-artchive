<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('frontend', 'Conectarse');
?>
<div class="container">
    <div class="default-form">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><?= Yii::t('frontend', 'Por favor, rellena los siguientes apartados para conectarte:') ?></p>


        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                <?= Yii::t('frontend', 'Si has olvidado tu contraseña puedes') ?>
                <?= Html::a(Yii::t('frontend', 'resetearla'), ['site/request-password-reset']) ?>.
            </div>

            <div class="form-group text-center">
                <?= Html::submitButton(Yii::t('frontend', 'Conectarte'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
