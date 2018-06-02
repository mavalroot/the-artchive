<?php

/* @var $this yii\web\View */
$this->title = 'The Artchive';
$render;
$more = [];
if (Yii::$app->user->isGuest) {
    $render = '_guests';
} else {
    $render = '_logged';
    $more = ['publicaciones' => $publicaciones];
}
?>

<?= $this->render($render, ['model' => $model] + $more);
