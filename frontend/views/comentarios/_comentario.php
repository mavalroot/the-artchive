<div class="comentario" id="com<?= $comentario->id ?>">
    <div class="comentario-head">
        <span class="username">
            <?= $comentario->getUsername() ?> ha comentado:
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
        <?= $comentario->getResponderButton() ?>
        <?= $comentario->getBorrarButton() ?>
        <?= $comentario->getMostrarRespuestasButton() ?>
    </div>
</div>
