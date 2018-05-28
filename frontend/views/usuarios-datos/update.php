<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosDatos */

$this->title = Yii::t('frontend', 'Modificar mi perfil');
$this->params['breadcrumbs'][] = ['label' => $model->getName(), 'url' => $model->getMiPerfil()];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Modificar');
?>
<div class="estandar-action">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

        <h3><?= Yii::t('frontend', 'Darse de baja') ?></h3>
        <div class="estandar-form">
        <p>
            <?= Yii::t('frontend/long', 'Eliminar tu cuenta significa la desaparición de todos tus datos, así como de tus publicaciones y personajes en caso de que así lo desees. En ningún caso se borrarán los comentarios que hiciste en otras publicaciones, pero tranquilo, tu nombre de usuario no se verá implicado.<br />
            Esta acción no podrá ser revertida, así que considéralo sólo cuando estés completamente seguro de que ya no quieres seguir en The Artchive.') ?>
        </p>
        <div class="text-center">
            <?= Html::a(Yii::t('frontend', 'Quiero darme de baja'), ['delete-account/index', 'primary' => true], ['class' => 'btn btn-danger', 'id' => 'delete-account']); ?>
        </div>
    </div>
</div>

<?php
$isMobile = preg_match('/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i', $_SERVER['HTTP_USER_AGENT']);
if (!$isMobile) {
    $js = <<< JS
    deleteAccount()
JS;
    $this->registerJs($js);
}
