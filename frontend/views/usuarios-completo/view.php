<?php
use yii\grid\GridView;

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = $model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-view">

    <?php if ($model->siguiendo()): ?>
        <input type="button" name="" value="Ya sigues a este usuario" disabled>
    <?php else: ?>
        <form name="seguir" method="post">
            <input type="hidden" name="id" value="<?= $model->id ?>">
            <button type="submit">Seguir</button>
        </form>
    <?php endif; ?>

    <?= $model->getFollowButtons() ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            [
                'attribute' => 'email',
                'value' => function ($model) {
                    return $model->isSelf() ? $model->email : '';
                }
            ],
            'aficiones',
            'tematica_favorita',
            'plataforma',
            'pagina_web',
            'avatar',
            'tipo',
            'seguidores',
            'siguiendo',
            'created_at:date',
            'updated_at:relativeTime',
        ],
    ]) ?>

    <?= $model->getButtons() ?>

    <div class="row">
        <div class="col-sm-6">
            <h2>Personajes recientes</h2>
            <?= GridView::widget([
                'dataProvider' => $model->getMisPersonajes(),
                'columns' => [
                    [
                        'attribute' => 'nombre',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getUrl();
                        }
                    ],
                    'created_at:date',
                    'updated_at:relativeTime',
                ],
            ]); ?>

            <?= Html::a('Ver personajes', ['personajes/index', 'username' => $model->username], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-sm-6">
            <h2>Publicaciones recientes</h2>
            <?= GridView::widget([
                'dataProvider' => $model->getMisPublicaciones(),
                'columns' => [
                    [
                        'attribute' => 'titulo',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getUrl();
                        }
                    ],
                    'created_at:date',
                    'updated_at:relativeTime',
                ],
            ]); ?>

            <?= Html::a('Ver publicaciones', ['publicaciones/index', 'username' => $model->username], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>

<?php

$js = <<< JS
$('form[name="seguir"]').on('submit', function(e) {
    e.preventDefault();
    $.post('usuarios-completo/seguir', $(this).serialize(), function(data) {
        alert(data);
    });
});
JS;

$this->registerJs($js);
