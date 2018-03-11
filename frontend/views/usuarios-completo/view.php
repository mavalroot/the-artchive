<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios Completos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-completo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            'aficiones',
            'tematica_favorita',
            'plataforma',
            'pagina_web',
            'avatar',
            'tipo_usuario',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
