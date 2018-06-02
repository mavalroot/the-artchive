<?php

use yii\data\ActiveDataProvider;

use yii\helpers\Html;
use yii\widgets\ListView;
use nirvana\infinitescroll\InfiniteScrollPager;

?>
<link rel="stylesheet" href="/css/homelogged.css">
<div class="row">
    <div class="col-sm-4">
        <div id="me-home">
            <div class="username">
                <h3><?= $model->getUrl() ?></h3>
            </div>
            <div class="avatar">
                <img src="<?= $model->avatar ?: '/uploads/default.png' ?>" alt="Avatar">
            </div>
            <ul class="stats">
                <li><?= Yii::t('frontend', 'Seguidores') ?> <h4><?= $model->seguidores ?></h4></li>
                <li><?= Yii::t('frontend', 'Siguiendo') ?> <h4><?= $model->siguiendo ?></h4></li>
                <li><?= Yii::t('frontend', 'Personajes') ?> <h4><?= $model->personajes ?></h4></li>
                <li><?= Yii::t('frontend', 'Publicaciones') ?> <h4><?= $model->publicaciones ?></h4></li>
            </ul>
        </div>
        <div id="random-artist">
            <?= Yii::t('frontend', 'Conoce un artista al azar') ?>
        </div>
        <div id="lateral-footer">
            <h5><?= Yii::t('frontend', 'Sobre nosotros') ?></h5>
            <ul>
                <li><a href="/site/about"><?= Yii::t('frontend', 'Sobre nosotros') ?></a></li>
                <li><a href="#"><?= Yii::t('frontend', 'Sobre The Artchive') ?></a></li>
                <li><a href="/site/contact"><?= Yii::t('frontend', 'Contactar') ?></a></li>
            </ul>
            <h5><?= Yii::t('frontend', 'Soporte') ?></h5>
            <ul>
                <li><a href="/podium/home"><?= Yii::t('frontend', 'Foro') ?></a></li>
                <li><a href="#"><?= Yii::t('frontend', 'Preguntas frecuentes') ?></a></li>
                <li><a href="#"><?= Yii::t('frontend', 'Términos y condiciones de uso') ?></a></li>
                <li><a href="/reportes/create"><?= Yii::t('frontend', 'Reporta un problema') ?></a></li>
                <li><a href="/reportes/index"><?= Yii::t('frontend', 'Tus reportes') ?></a></li>
            </ul>
            <ul>
                <li>© <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> by <a href="http://www.mavalroot.es/">mavalroot</a></li>
            </ul>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="publicaciones">

            <?=
            ListView::widget([
                'id' => 'feed',
                'dataProvider' => new ActiveDataProvider([
                    'query' => $publicaciones,
                    'pagination' => [
                        'pageSize' => 5,
                    ],
                ]),
                'layout' => "{summary}\n<div class=\"items\">{items}</div>\n{pager}",
                'itemView' => '/publicaciones/_publicaciones',
                'summary' => '',
                'emptyText' => Yii::t('frontend', 'Aquí no hay nada :(. ¿Por qué no empiezas a seguir a algún usuario?'),
                'pager' =>
                ['class' => InfiniteScrollPager::className(),
                    'widgetId' => 'feed',
                    'itemsCssClass' => 'items',
                    'pluginOptions' => [
                        'loading' => [
                            'msgText' => '<span><i class="fas fa-spinner fa-pulse"></i></span>',
                            'finishedMsg' => Yii::t('frontend', '¡Felicidades! Has llegado al final.'),
                        ],
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
</div>
