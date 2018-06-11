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
        El siguiente error ocurrió mientras el servidor estaba procesando tu petición.
    </p>
    <p>
    </p>
        Por favor, ponte en contacto con nosotros si crees que fue un error del servidor. Gracias.
    </p>

</div>
