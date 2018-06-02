<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$language = '<div id="change-language"><button title="Change language to english" alt="Change language to english" type="button" class="flag-button' . (Yii::$app->language ==  'en-EN' ? ' flag-selected' : '') .
'" value="en-EN"><span class="flag-icon flag-icon-gb"></span></button>
<button title="Cambiar idioma a español" alt="Cambiar idioma a español"  type="button" class="flag-button' . (Yii::$app->language ==  'es-ES' ? ' flag-selected' : '') . '" value="es-ES">
<span class="flag-icon flag-icon-es"></span>
</button>
</div>';
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
    <div id="particles-js"></div>
    <div id="home-guest" class="container-fluid">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="oneline">

    <ul>
        <li>
            <?= $language ?>
        </li>
        <li><a href=""><?= Yii::t('frontend', 'Sobre nosotros') ?></a></li>
        <li><a href=""><?= Yii::t('frontend', 'Sobre The Artchive') ?></a></li>
        <li><a href=""><?= Yii::t('frontend', 'Términos y condiciones') ?></a></li>
        <li><a href=""><?= Yii::t('frontend', 'Preguntas frecuentes') ?></a></li>
        <li><a href=""><?= Yii::t('frontend', 'Contactar') ?></a></li>
        <li>© <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> by <a href="http://www.mavalroot.es/">mavalroot</a></li>
    </ul>
</footer>
<script src="js/plugins/particles.min.js" charset="utf-8"></script>
<script src="js/plugins/myparticles.js" charset="utf-8"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
