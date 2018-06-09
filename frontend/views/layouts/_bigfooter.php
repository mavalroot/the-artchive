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
                    <li><?= Html::a(Yii::t('frontend', 'Sobre nosotros'), ['/site/about']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'Contactar'), ['/site/contact']) ?></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5><?= Yii::t('frontend', 'Soporte') ?></h5>
                <ul>
                    <li><?= Html::a(Yii::t('frontend', 'Foro'), ['/podium/home']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'Reporta un problema'), ['/reportes/create']) ?></li>
                    <li><?= Html::a(Yii::t('frontend', 'Tus reportes'), ['/reportes/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> by <a href="http://www.mavalroot.es/">mavalroot</a></p>
    </div>
</footer>
