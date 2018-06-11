<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Comentarios */

$this->title = '#' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$username = User::findOne($model->usuario_id)->username;
?>
<div class="comentarios-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'username',
                'format' => 'html',
                'value' => Html::a($username, ['/usuarios-completo/view', 'username' => $username]),
            ],
            [
                'attribute' => 'publicacion_id',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a('Publicación', ['/publicacion/view', 'id' => $model->publicacion_id]);
                }
            ],
            [
                'attribute' => 'comentario_id',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->comentario_id) {
                        return Html::a('Comentario id', ['view', 'id' => $model->comentario_id]);
                    }
                    return null;
                }
            ],
            'contenido',
            'deleted:boolean',
            'created_at:datetime',
        ],
    ]) ?>

</div>
