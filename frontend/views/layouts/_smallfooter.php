<?php
use yii\helpers\Html;

$language = '<div id="change-language"><button title="Change language to english" type="button" class="flag-button' . (Yii::$app->language ==  'en-EN' ? ' flag-selected' : '') .
'" value="en-EN"><span class="flag-icon flag-icon-gb"></span></button>
<button title="Cambiar idioma a español" type="button" class="flag-button' . (Yii::$app->language ==  'es-ES' ? ' flag-selected' : '') . '" value="es-ES">
<span class="flag-icon flag-icon-es"></span>
</button>
</div>';
?>

<footer class="oneline">
    <ul>
        <li>
            <?= $language ?>
        </li>
        <li><?= Html::a(Yii::t('frontend', 'Inicio'), ['/site/index']) ?></li>
        <li><?= Html::a(Yii::t('frontend', 'Sobre nosotros'), ['/site/about']) ?></li>
        <li><?= Html::a(Yii::t('frontend', 'Contactar'), ['/site/contact']) ?></li>
        <li>© <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> by <a href="http://www.mavalroot.es/">mavalroot</a></li>
    </ul>
</footer>
