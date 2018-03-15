<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SeguidoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$username = Yii::$app->request->get('username');

$this->title = 'Siguiendo';
$this->params['breadcrumbs'][] = ['label' => $username, 'url' => ['/usuarios-completo/view', 'username' => $username]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguidores-siguiendo">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'user_id',
        ],
    ]); ?>
</div>
