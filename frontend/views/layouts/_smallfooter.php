<?php
use yii\helpers\Html;

$language = '<div id="change-language"><button title="Change language to english" alt="Change language to english" type="button" class="flag-button' . (Yii::$app->language ==  'en-EN' ? ' flag-selected' : '') .
'" value="en-EN"><span class="flag-icon flag-icon-gb"></span></button>
<button title="Cambiar idioma a español" alt="Cambiar idioma a español"  type="button" class="flag-button' . (Yii::$app->language ==  'es-ES' ? ' flag-selected' : '') . '" value="es-ES">
<span class="flag-icon flag-icon-es"></span>
</button>
</div>';
?>

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
