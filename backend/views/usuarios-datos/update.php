<?php

use yii\helpers\Html;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosDatos */

$username = User::findOne($model->usuario_id)->username;
$this->title = 'Editar datos personales: ' . $username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['/usuarios-completo/index']];
$this->params['breadcrumbs'][] = ['label' => $username, 'url' => ['/usuarios-completo/view', 'username' => $username]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuarios-datos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
