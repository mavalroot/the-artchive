<?php

use yii\data\ActiveDataProvider;

use yii\helpers\Html;
use yii\widgets\ListView;
use nirvana\infinitescroll\InfiniteScrollPager;

?>

<div class="row">
    <div class="col-sm-4">
        <div id="me-home">
            <div class="username">
                <?= $model->username ?>
            </div>
            <div class="avatar">
                <img src="<?= $model->avatar ?: '/uploads/default.png' ?>" alt="Avatar" style="width: 100px">
            </div>
            <ul class="">
                <li>Seguidores: <?= $model->seguidores ?></li>
                <li>Siguiendo: <?= $model->siguiendo ?></li>
                <li>Mensajes: </li>
                <li>Comentarios: </li>
                <li>Pesonajes: </li>
                <li>Publicaciones: </li>
            </ul>
        </div>
        <div id="random-artist">
            Conoce un artista al azar
        </div>
        <div id="footer">
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
                'emptyText' => 'Aquí no hay nada.',
                'pager' =>
                ['class' => InfiniteScrollPager::className(),
                    'widgetId' => 'feed',
                    'itemsCssClass' => 'items',
                    'pluginOptions' => [
                        'loading' => [
                            'msgText' => '<i class="fas fa-spinner fa-pulse"></i>',
                            'finishedMsg' => 'No hay nada más',
                        ],
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
</div>
