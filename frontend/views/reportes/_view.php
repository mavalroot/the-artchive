<?php
use common\models\UsuariosCompleto;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reportes */

$user = UsuariosCompleto::findOne(['id' => $model->created_by]);
?>

<div class="reportes-view">
    <div class="nombre">
        <h1>
            <?= Yii::$app->formatter->asText($model->referencia) ?> ( <?= Yii::$app->formatter->asText($model->estado) ?> )
        </h1>
    </div>
    <div class="contenido">
        <?= Yii::$app->formatter->asNText($model->contenido) ?>
    </div>
    <div class="usuario">
        <?= Html::a($user->getImgAvatar() . $user->username, ['/usuarios-completo/view', 'username' => $user->username]) ?>
        <small>[ <?= Yii::$app->formatter->asDateTime($model->created_at) ?> ]</small>
    </div>
    <div class="respuesta">
        <h2><?= Yii::t('frontend', 'Respuesta') ?></h2>
        <p>
            <?php if (!$model->respuesta) : ?>
                <?= Yii::t('frontend', 'Gracias por contactar con nosotros. Revisaremos tu reporte lo más pronto posible.') ?>
            <?php else : ?>
                <?= Yii::$app->formatter->asNText($model->respuesta) ?>
            <?php endif; ?>
        </p>
    </div>
</div>
