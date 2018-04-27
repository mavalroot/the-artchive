<?php
use yii\grid\GridView;

use common\models\UsuariosCompleto;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = $model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-view">

    <div id="follow-actions">
    <?php if ($model->siguiendo()): ?>
        <form name="unfollow" method="post">
            <input type="hidden" name="id" value="<?= $model->id ?>">
            <button type="submit" class="btn btn-sm btn-secondary">Dejar de seguir</button>
        </form>
    <?php else: ?>
        <form name="follow" method="post">
            <input type="hidden" name="id" value="<?= $model->id ?>">
            <button type="submit" class="btn btn-sm btn-primary">Seguir</button>
        </form>
    <?php endif; ?>

        <?= $model->getFollowButtons() ?>
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
function follow(name) {
    $('#follow-actions').on('submit','form[name="'+name+'"]', function(e) {
        e.preventDefault();
        let that = $(this);
        $.post('usuarios-completo/'+name, $(this).serialize(), function(data) {
            if (data) {
                $("#follow-actions").load(location.href+" #follow-actions>*","");
            }
        });
    });
}

follow('follow');
follow('unfollow');
JS;

$this->registerJs($js);
