<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('frontend', 'Sobre nosotros');
?>
<div class="container">
    <div class="site-about" itemscope itemtype="http://schema.org/Organization">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="speech-bubble">
            <p itemprop="description">
                <?= Yii::t('frontend/long', '<span itemprop="brand">The Artchive</span> nace como un proyecto de fin de curso, ¿la idea? Reunir en un mismo espacio, a modo de red social, a creadores de contenido que quieran compartir sus creaciones con otros.'); ?>
            </p>
            <p>
                <?= Yii::t('frontend', 'Su creador es') ?> <span itemprop="name"><?= Yii::$app->params['adminName'] ?></span>.
            </p>
            <p>
                <?= Yii::t('frontend/long', 'The Artchive puede estar <span itemprop="address">en cualquier parte</span>. Y si quieres contactar con nosotros puedes hacerlo a través de <span itemprop="telephone"><a href="/site/contact">Contactar</a></span>.'); ?>
            </p>
        </div>
        <div class="text-right">
            <img src="/img/artchive.svg" height="300px" width="300px" alt="The Artchive" itemprop="logo">
        </div>
        <div class="about-video">
            <h2>
                <?= Yii::t('frontend', 'Y recuerda, ¡se amable!') ?>
            </h2>
            <iframe src="https://www.youtube.com/embed/_Wdkbp0FfLk?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </div>
</div>
