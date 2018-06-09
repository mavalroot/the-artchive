<?php
use yii\helpers\Html;

?>

<footer id="myFooter">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <a href="/">
                    <h2 class="logo"> THE ARTCHIVE </h2>
                    <img src="/img/artchive.svg" alt="The Artchive">
                </a>
            </div>

            <div class="col-sm-3">
                <h5><?= Yii::t('frontend', 'Sobre nosotros') ?></h5>
                <ul>
                    <li><a href="/site/about"><?= Yii::t('frontend', 'Sobre nosotros') ?></a></li>
                    <li><a href="/site/contact"><?= Yii::t('frontend', 'Contactar') ?></a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5><?= Yii::t('frontend', 'Soporte') ?></h5>
                <ul>
                    <li><a href="/podium/home"><?= Yii::t('frontend', 'Foro') ?></a></li>
                    <li><a href="/reportes/create"><?= Yii::t('frontend', 'Reporta un problema') ?></a></li>
                    <li><a href="/reportes/index"><?= Yii::t('frontend', 'Tus reportes') ?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> by <a href="http://www.mavalroot.es/">mavalroot</a></p>
    </div>
</footer>
