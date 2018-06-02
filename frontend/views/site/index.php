<?php

/* @var $this yii\web\View */
$this->title = 'Artchive';
$render;
$more = [];
if (Yii::$app->user->isGuest) {
    $render = '_guests';
    $more = ['model' => $model];
} else {
    $render = '_logged';
}
?>

<?= $this->render($render, $more) ?>
