<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SeguidoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$username = Yii::$app->request->get('username');

$this->title = Yii::t('frontend', 'Siguiendo');
$this->params['breadcrumbs'][] = ['label' => $username, 'url' => ['/usuarios-completo/view', 'username' => $username]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguidores-siguiendo">

        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]);?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'signame',
                    'label' => 'Siguiendo',
                    'format' => 'html',
                    'value' => function ($model) {
                        return Html::a(
                            Html::img($model->sigavatar ?: '/uploads/default.png') . $model->signame,
                            ['/usuarios-completo/view', 'username' => $model->signame],
                            ['class' => 'follow-thing']
                        );
                    }
                ]
            ],
        ]); ?>
</div>

<style media="screen">
    tbody {
        display: flex;
        flex-wrap: wrap;
    }
</style>
