<?php
use yii\helpers\Html;

use common\models\UsuariosCompleto;

?>

<div class="comentario" id="com<?= $comentario->id ?>">
    <div class="comentario-head">
        <div class="avatar">
            <?= Html::img($comentario->avatar ?: '/uploads/default.jpg') ?>
        </div>
        <span class="username">
            <?= Html::a($comentario->username, ['/usuarios-completo/view', 'username' => $comentario->username]) ?> ha comentado:
        </span>
    </div>
    <div class="comentario-body">
        <div class="contenido">
            <?php if ($comentario->isDeleted()) : ?>
                <em class="text-danger"><?= Yii::t('frontend', 'Este comentario ha sido eliminado.') ?></em>
            
            <?php else: ?>
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
