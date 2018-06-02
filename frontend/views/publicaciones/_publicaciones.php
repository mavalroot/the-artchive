<?php
use yii\helpers\Html;

use common\models\UsuariosCompleto;
use kartik\markdown\Markdown;

$owner = UsuariosCompleto::findOne(['id' => $model->usuario_id]);
?>

<div class="publicacion" style="min-height: 400px;">
    <div class="publicacion-header">
        <div class="user">
            <div class="avatar">
                <?= Html::a($owner->getImgAvatar(), ['/usuarios-completo/view', 'username' => $owner->username])  ?>
            </div>
        </div>
        <div class="titulo">
            <h3><?= Html::a(Yii::$app->formatter->asText($model->titulo), $model->getRawUrl()); ?></h3>
        </div>
    </div>
    <small><?= Yii::$app->formatter->asDateTime($model->created_at) ?></small>
    <div class="publicacion-body">
        <div class="contenido">
            <?= Yii::$app->formatter->asHtml(Markdown::convert($model->contenido)) ?>
        </div>
    </div>
    <div class="publicacion-footer">
        <div class="updated">
            <i class="fas fa-edit"></i> <?= Yii::$app->formatter->asRelativeTime($model->updated_at) ?>
        </div>
        <div class="comentarios">
            <?= Html::a('<i class="fas fa-comments"></i> ' . count($model->comentarios), $model->getRawUrl()); ?>
        </div>
    </div>
</div>

<style media="screen">
    .avatar img {
        width: 50px;
        border-radius: 100px;
    }

    .publicacion-header {
        display: flex;
        align-items: center;
    }
</style>
