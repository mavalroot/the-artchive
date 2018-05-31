<?php
use yii\helpers\Html;

use common\models\UsuariosCompleto;

$user = UsuariosCompleto::findOne(['id' => $comentario->usuario_id]);
?>

<div class="comentario" id="com<?= $comentario->id ?>">
    <div class="comentario-head">
        <div class="avatar">
            <?= Html::img($user->avatar ?: '/uploads/default.jpg') ?>
        </div>
        <span class="username">
            <?= $user->getUrl() ?> ha comentado:
        </span>
    </div>
    <div class="comentario-body">
        <div class="contenido">
            <?php if ($comentario->isDeleted()) : ?>
                <?= Yii::$app->formatter->asRaw($comentario->contenido); ?>
            <?php else : ?>
                <?= Yii::$app->formatter->asnText($comentario->contenido) ?>
            <?php endif; ?>
        </div>
        <div class="time">
            <?= Yii::$app->formatter->asRelativeTime($comentario->created_at) ?>
        </div>
    </div>
    <div class="comentario-botones">
        <input type="hidden" name="id" value="<?= $comentario->id ?>">
        <?= $comentario->getBorrarButton() ?>
        <?php if (!$respuesta): ?>
            <input type="hidden" name="publicacion" value="<?= $publicacion ?>">
            <?= $comentario->getResponderButton() ?>
            <?= $comentario->getMostrarRespuestasButton() ?>
        <?php endif; ?>
    </div>
</div>
