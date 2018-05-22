<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UsuariosCompletoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios Completos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'username',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getUrl();
                }
            ],
            'status',
            'email:email',
        ],
    ]); ?>
</div>
