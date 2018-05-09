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
        <h3>Mostar/Ocultar <?= count($model->getComentarios()->all()) ?> comentarios</h3>
    </div>
    <div class="publicacion-comentarios">
        <?php foreach ($comentarios as $comentario): ?>
            <div class="comentario" id="com<?= $comentario->id ?>">
                <div class="comentario-head">
                    <span class="permalink-username">
                        <?= $comentario->getPermalink() ?> <?= $comentario->getUsername() ?>
                    </span>
                    <small>
                        [<?= Yii::$app->formatter->asDateTime($comentario->created_at) ?>]
                    </small>
                </div>
                <div class="comentario-botones">
                    <!-- Editar / Borrar -->
                </div>
                <div class="comentario-body">
                    <div class="quote">
                        <?= $comentario->getRespuestaUrl() ?>
                    </div>
                    <div class="contenido">
                        <?= Yii::$app->formatter->asnText($comentario->contenido) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="nuevo-comentario">
            <h3>Publicar comentario</h3>
            <form name="nuevo-comentario" method="post">
                <textarea name="name" class="form-control" rows="5"></textarea>
                <input type="button" class="btn btn-success" value="Enviar">
            </form>
        </div>
    </div>

</div>
