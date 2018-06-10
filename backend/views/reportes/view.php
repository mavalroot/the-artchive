<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\UsuariosCompleto;

/* @var $this yii\web\View */
/* @var $model common\models\Reportes */

$this->title = $model->referencia;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$user = UsuariosCompleto::findOne(['id' => $model->created_by]);
?>
<div class="reportes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Responder'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'estado',
            'referencia',
            'contenido:ntext',
            'respuesta',
            [
                'attribute' => 'creator',
                'format' => 'html',
                'value' => $user->getUrl(),
            ],
            'created_at:datetime',
        ],
    ]) ?>

</div>
