<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Artchive';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Artchive</h1>
        <p class="lead">Esta es la portada</p>
    </div>

    <div class="body-content">
        <?= Yii::t('frontend', 'Hola') ?>
        <br /><br />
        <?= Html::beginForm(['site/switch-language'], 'post') ?>
        <?= Html::hiddenInput('redirectTo', \yii\helpers\Url::to(Yii::$app->request->url)) ?>
        <?= Html::beginTag('select', ['name' => 'language', 'onchange' => 'this.form.submit();']) ?>
        <?= Html::renderSelectOptions(\Yii::$app->language, [
            'en-EN' => '<span class="flag-icon flag-icon-en"></span> English',
            'es-ES' => '<span class="flag-icon flag-icon-es"></span> Español',
            ]) ?>
            <?= Html::endTag('select') ?>
            <?= Html::endForm() ?>
        <div id="change-language">
            <button type="button" class="flag-button<?= Yii::$app->language ==  'en-EN' ? ' flag-selected' : '' ?>" value="en-EN">
                <span class="flag-icon flag-icon-gb"></span>
            </button>
            <button type="button" class="flag-button <?= Yii::$app->language ==  'es-ES' ? ' flag-selected' : '' ?>" value="es-ES">
                <span class="flag-icon flag-icon-es"></span>
            </button>
        </div>



       <p>Current language is <?= Html::encode(\Yii::$app->language) ?> </p>

        <div class="row">
            <div class="col-lg-4">
                <h2>Aquí podrían ir publicaciones recientes...</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
            </div>
            <div class="col-lg-4">
                <h2>Aquí podrían ir personajes recientes...</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
            </div>
            <div class="col-lg-4">
                <h2>Aquí podrían ir noticias...</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>
            </div>
        </div>

    </div>
</div>
