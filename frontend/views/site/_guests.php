<?php
use yii\helpers\Html;

use yii\widgets\ActiveForm;

?>

<div id="login" class="container-fluid">
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => '/site/login']); ?>
    <div class="row flex">
        <div>
            <?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t('frontend', 'Usuario')])->label(false) ?>
        </div>

        <div>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('frontend', 'Contraseña')])->label(false) ?>
        </div>

        <div>
            <?= Html::submitButton(Yii::t('frontend', 'Conectarte'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
    <div class="row text-right">
            <?= Html::a(Yii::t('frontend', '¿Has olvidado tu contraseña?'), ['site/request-password-reset']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="myflex">
    <div id="summary" class="row">
        <ul class="fa-ul">
            <li><span class="fa-li"><i class="fas fa-pencil-alt"></i></span> Crea contenido</li>
            <li><span class="fa-li"><i class="fas fa-users"></i></span> Conecta con la gente</li>
            <li><span class="fa-li"><i class="fas fa-paper-plane"></i></span> Comparte tus creaciones</li>
        </ul>
    </div>

    <div id="description" class="row">
        <img src="http://placehold.it/100" alt="Logo"><br />
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </div>

    <div id="join" class="row">
        <h3>Únete</h3>
        <ul>
            <li>
                <a class="join-button" href="/site/login"><i class="fas fa-user-plus"></i> Registrarse</a>
            </li>
            <li>
                <a class="join-button" href="/site/signup"><i class="fas fa-sign-in-alt"></i> Conectarse</a>
            </li>
        </ul>
    </div>
</div>
