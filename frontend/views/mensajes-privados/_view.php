<?php
use yii\helpers\Html;
use common\models\UsuariosCompleto;

/* @var $this yii\web\View */
/* @var $model common\models\MensajesPrivados */

$usuario = UsuariosCompleto::findOne(['id' => $model->emisor_id])
?>

<div class="mensajes-privados">
    <div class="mensajes-privados-header">
        <div class="user">
            <div class="avatar">
                <?= Html::a($usuario->getImgAvatar(), ['/usuarios-completo/view', 'username' => $usuario->username])  ?>
            </div>
        </div>
        <div class="asunto">
            <h2><?= Html::a(Yii::$app->formatter->asText($model->asunto), $model->getRawUrl()); ?></h2>
        </div>
        <small><?= Yii::$app->formatter->asDateTime($model->created_at) ?></small>
    </div>
    <div class="mensajes-privados-body">
        <div class="buttons">
            <?= Html::a('<i class="fas fa-trash-alt"></i> ' . Yii::t('app', 'Borrar'), ['/mensajes-privados/delete', 'id' => $model->id], [
                'class' => 'btn btn-link',
                'data' => [
                    'confirm' => Yii::t('app', '¿Seguro que desea borrar el mensaje privado? No podrá ser recuperado.'),
                    'method' => 'post',
                ],
            ]); ?>
            <?= Html::beginForm('/mensajes-privados/create', 'post') .
                Html::hiddenInput('receptor_id', $model->emisor_id) .
                Html::hiddenInput('asunto', $model->asunto) .
                Html::submitButton('<i class="fas fa-paper-plane"></i> ' . Yii::t('app', 'Responder'), ['class' => 'btn btn-link']) .
                Html::endForm(); ?>
        </div>
        <h3><?= $model->getAttributeLabel('contenido') ?></h3>
        <div class="contenido">
            <?= Yii::$app->formatter->asText($model->contenido) ?>
        </div>
    </div>
</div>
