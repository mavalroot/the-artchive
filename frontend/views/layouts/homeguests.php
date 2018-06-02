<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/homeguests.css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div id="home-guest">
        <div id="particles-js"></div>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="oneline">
    <ul>
        <li><a href="">Sobre Nosotros</a></li>
        <li><a href="">Sobre The Artchive</a></li>
        <li><a href="">Términos y condiciones</a></li>
        <li><a href="">Preguntas frecuentes</a></li>
        <li><a href="">Contactar</a></li>
        <li><a href="">© <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> by <a href="http://www.mavalroot.es/">mavalroot</a></a></li>
    </ul>
</footer>
<script src="js/plugins/particles.min.js" charset="utf-8"></script>
<script src="js/plugins/myparticles.js" charset="utf-8"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
