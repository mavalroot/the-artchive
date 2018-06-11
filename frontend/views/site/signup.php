<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('frontend', 'Registrarse');
?>
<div class="container">
    <div class="default-form">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Yii::t('frontend', 'Por favor, rellena los siguientes apartados para registrarte:') ?>
        </p>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group text-center">
                <?= Html::submitButton(Yii::t('frontend', 'Registrarte'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <p>
                <?= Html::a(Yii::t('frontend', '¿Ya tienes cuenta? Conéctate aquí.'), ['/site/login']) ?>
            </p>

        <?php ActiveForm::end(); ?>
    </div>
</div>
