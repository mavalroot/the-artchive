<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Artchive';

$cookies = Yii::$app->response->cookies;
var_dump(Yii::$app->session['language']);
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Artchive</h1>

        <p class="lead">Esta es la portada</p>
    </div>

    <?= Html::a('Inglés', ['site/change-language', 'lang' => 'en-US']) ?>
    <?= Html::a('Español', ['site/change-language', 'lang' => 'es-ES']) ?>

    <div class="body-content">
        <?= Yii::t('frontend', 'Hola') ?>
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
