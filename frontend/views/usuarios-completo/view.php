<?php
use yii\grid\GridView;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = $model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-view">

    <?php if ($model->isBlocked()) : ?>
        <h1>Has bloqueado a este usuario</h1>
    <?php endif; ?>
    <div id="follow-actions">
    <?php if (!$model->isSelf() && $model->siguiendo()) : ?>
        <form name="unfollow" method="post">
            <input type="hidden" name="id" value="<?= $model->id ?>">
            <button type="submit" class="btn btn-sm btn-secondary">Dejar de seguir</button>
        </form>
    <?php elseif (!$model->isSelf() && !$model->siguiendo()) : ?>
        <form name="follow" method="post">
            <input type="hidden" name="id" value="<?= $model->id ?>">
            <button type="submit" class="btn btn-sm btn-primary">Seguir</button>
        </form>
    <?php endif; ?>

        <?= $model->getFollowButtons() ?>
    </div>

    <div id="block-actions">
        <?php if (!$model->isSelf() && $model->isBlocked()) : ?>
            <form name="unblock" method="post">
                <input type="hidden" name="id" value="<?= $model->id ?>">
                <button type="submit" class="btn btn-sm btn-primary">Desbloquear</button>
            </form>
        <?php elseif (!$model->isSelf() && !$model->isBlocked()) : ?>
            <form name="block" method="post">
                <input type="hidden" name="id" value="<?= $model->id ?>">
                <button type="submit" class="btn btn-sm btn-primary">Bloquear</button>
            </form>
        <?php endif; ?>
    </div>
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
            'pagina_web:url',
            'tipo',
            'seguidores',
            'siguiendo',
            'created_at:date',
            'updated_at:relativeTime',
            [
            'attribute' => 'avatar',
            'value' => function ($model) {
                if ($model->avatar) {
                    return $model->avatar;
                }
                return '/uploads/default.jpg';
            },
            'format' => 'image',
            ],
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
actionButton('follow', '.usuarios-completo-view', '#follow-actions');
actionButton('unfollow', '.usuarios-completo-view', '#follow-actions');
actionButton('block', '.usuarios-completo-view', '.usuarios-completo-view');
actionButton('unblock', '.usuarios-completo-view', '.usuarios-completo-view');
JS;

$this->registerJs($js);
