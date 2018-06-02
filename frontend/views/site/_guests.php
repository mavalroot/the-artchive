<?php
use yii\helpers\Html;

use yii\widgets\ActiveForm;

?>

<div id="login">
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => '/site/login']); ?>
    <div class="row flex">
        <div>
            <?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t('frontend', 'Nombre de usuario')])->label(false) ?>
        </div>

        <div>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('frontend', 'Contraseña')])->label(false) ?>
        </div>

        <div>
            <?= Html::submitButton(Yii::t('frontend', 'Conectarte'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
    <div class="row text-right">
            <small>
                <?= Html::a(Yii::t('frontend', '¿Has olvidado tu contraseña?'), ['site/request-password-reset']) ?>
            </small>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="myflex">
    <div id="summary" class="row">
        <ul class="fa-ul">
            <li><span class="fa-li"><i class="fas fa-pencil-alt"></i></span> <?= Yii::t('frontend', 'Crea contenido') ?></li>
            <li><span class="fa-li"><i class="fas fa-users"></i></span> <?= Yii::t('frontend', 'Conecta con la gente') ?></li>
            <li><span class="fa-li"><i class="fas fa-paper-plane"></i></span> <?= Yii::t('frontend', 'Comparte tus creaciones') ?></li>
        </ul>
    </div>

    <div id="description" class="row">
        <img src="http://placehold.it/100" alt="Logo"><br />
        <?= Yii::t('frontend', 'The Artchive es una red social para creadores de contenido donde puedes compartir tus personajes y escritos.') ?>
    </div>

    <div id="join" class="row">
        <h3><?= Yii::t('frontend', 'Únete ya') ?></h3>
        <ul>
            <li>
                <a class="join-button" href="/site/login"><i class="fas fa-user-plus"></i> <?= Yii::t('frontend', 'Registrarse') ?></a>
            </li>
            <li>
                <a class="join-button" href="/site/signup"><i class="fas fa-sign-in-alt"></i> <?= Yii::t('frontend', 'Conectarse') ?></a>
            </li>
        </ul>
    </div>
</div>
