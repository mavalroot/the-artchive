<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ComentariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comentarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'username',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->username, ['/usuarios-completo/view', 'username' => $model->username]);
                }
            ],
            [
                'attribute' => 'publicacion_id',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a('Publicación', ['/publicaciones/view', 'id' => $model->publicacion_id]);
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
            'deleted:boolean',
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
