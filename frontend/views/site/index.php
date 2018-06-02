<?php

/* @var $this yii\web\View */
$this->title = 'Artchive';
$render;
if (Yii::$app->user->isGuest) {
    $render = '_guests';
} else {
    $render = '_logged';
}
?>

<?= $this->render($render) ?>
