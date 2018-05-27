<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <?= Yii::t('frontend', 'Este error ocurrió mientras el servidor procesaba tu respuesta.') ?>
    </p>
    <p>
        <?= Yii::t('frontend', 'Por favor contacta con nosotros si piensas que es un error del servidor. Gracias.') ?>
    </p>

</div>
