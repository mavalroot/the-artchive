<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosDatos */

$this->title = 'Modificar mi perfil';
$this->params['breadcrumbs'][] = ['label' => $model->getName(), 'url' => $model->getMiPerfil()];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="estandar-action">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        <h3>Darse de baja</h3>
        <div class="estandar-form">
        <p>
            Eliminar tu cuenta significa la desaparición de todos tus datos, así como de tus publicaciones y personajes en caso de que así lo desees. En ningún caso se borrarán los comentarios que hiciste en otras publicaciones, pero tranquilo, tu nombre de usuario no se verá implicado.<br />
            Esta acción no podrá ser revertida, así que considéralo sólo cuando estés completamente seguro de que ya no quieres seguir en The Artchive.
        </p>
        <div class="text-center">
            <?= Html::a('Quiero darme de baja', ['delete-account/index'], ['class' => 'btn btn-danger']); ?>
        </div>
    </div>
</div>
