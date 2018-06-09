<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SeguidoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$username = Yii::$app->request->get('username');

$this->title = Yii::t('frontend', 'Seguidores');
$this->params['breadcrumbs'][] = ['label' => $username, 'url' => ['/usuarios-completo/view', 'username' => $username]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguidores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'segname',
                'label' => 'Seguidores',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a(
                        Html::img($model->segavatar ?: '/uploads/default.png') . $model->segname,
                        ['/usuarios-completo/view', 'username' => $model->segname],
                        ['class' => 'follow-thing']
                    );
                }
            ]
        ],
    ]); ?>
</div>
