<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PublicacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$username = Yii::$app->request->get('username');

$this->title = Yii::t('frontend', 'Publicaciones');
$this->params['breadcrumbs'][] = ['label' => $username, 'url' => ['usuarios-completo/view', 'username' => $username]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'titulo',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getUrl();
                }
            ],
            'created_at:datetime',
            'updated_at:relativetime',
        ],
    ]); ?>
</div>
