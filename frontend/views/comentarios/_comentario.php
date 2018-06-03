<?php
use yii\helpers\Html;

?>

<div class="comentario" id="com<?= $comentario->id ?>">
    <div class="comentario-head">
        <div class="avatar">
            <?= Html::img($comentario->avatar ?: '/uploads/default.png') ?>
        </div>
        <span class="username">
            <?= Html::a($comentario->username, ['/usuarios-completo/view', 'username' => $comentario->username]) ?> ha comentado:
        </span>
    </div>
    <div class="comentario-body">
        <div class="contenido">
            <?php if ($comentario->isDeleted()) : ?>
                <em class="text-danger"><?= Yii::t('frontend', 'Este comentario ha sido eliminado.') ?></em>
            <?php elseif (!$comentario->isApto()) : ?>
                <em class="text-danger"><?= Yii::t('frontend', 'No puedes ver este comentario.') ?></em><br />
                <small><a href="">¿Por qué?</a></small>
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
        <?php if (!$respuesta) : ?>
            <input type="hidden" name="publicacion" value="<?= $publicacion ?>">
            <?= $comentario->getResponderButton() ?>
            <?= $comentario->getMostrarRespuestasButton() ?>
        <?php endif; ?>
    </div>
</div>
