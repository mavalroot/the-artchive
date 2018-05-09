<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Publicaciones */

$owner = $model->getUsuario()->one()->username;

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = ['label' => 'Publicaciones de ' . $owner, 'url' => ['index', 'username' => $owner]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            'created_at:datetime',
            'contenido:ntext',
            'updated_at:relativetime',
        ],
    ]) ?>

    <?php $model->getButtons() ?>

    <div id="toggle">
        Mostar/Ocultar comentarios
    </div>
    <div class="publicacion-comentarios">
        <?php foreach ($comentarios as $comentario): ?>
            <div class="comentario" id="com<?= $comentario->id ?>">
                <div class="comentario-head">
                    <span class="username">
                        <?= $comentario->getUsername() ?>
                    </span>
                    <small>
                        [<?= Yii::$app->formatter->asDateTime($comentario->created_at) ?>]
                    </small>
                </div>
                <div class="contenido">
                    <div class="permalink">
                        <?= $comentario->getPermalink() ?>
                    </div>
                    <div class="responde">
                        <?= $comentario->getRespuestaUrl() ?>
                    </div>
                    <?= Yii::$app->formatter->asnText($comentario->contenido) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
