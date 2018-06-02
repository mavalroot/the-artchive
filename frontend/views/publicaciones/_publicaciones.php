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
        <small><?= Yii::$app->formatter->asDateTime($model->created_at) ?></small>
    </div>
    <div class="publicacion-body">
        <div class="contenido">
            <?= Yii::$app->formatter->asHtml(Markdown::convert($model->contenido)) ?>
        </div>
    </div>
    <div class="publicacion-footer">
        <div class="comentarios">
            <?= Html::a('<i class="fas fa-comments"></i> ' . count($model->comentarios), $model->getRawUrl()); ?>
        </div>
        <div class="updated">
            <i class="fas fa-edit"></i> <?= Yii::$app->formatter->asRelativeTime($model->updated_at) ?>
        </div>
    </div>
</div>

<style media="screen">
    #feed .publicacion {
        margin-bottom: 20px;
        background: white;
        border: 2px solid #7967a6;
    }

    #feed .publicacion > .publicacion-header {
        background: linear-gradient(-90deg, #a367a6, #7967a6);
        padding: 10px;
    }

    #feed .publicacion > .publicacion-header > .user > .avatar img {
        width: 50px;
        border-radius: 100px;
        margin-right: 10px;
    }

    #feed .publicacion > .publicacion-header {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
    #feed .publicacion > .publicacion-header > small {
        width: 100%;
    }

    #feed .publicacion > .publicacion-body {
    }

    #feed .publicacion > .publicacion-body > .contenido {
        max-width: 700px;
        margin: auto;
        padding: 20px;
        font-size: 16px;
        line-height: 25px;
    }

    #feed .publicacion > .publicacion-footer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        border-top: 2px solid #7967a6;
    }

    #feed .publicacion > .publicacion-footer > div {
        padding: 10px;
    }



</style>
