<div class="comentarios-respuestas">
    <?php foreach ($comentarios as $comentario) : ?>
        <div class="comentario" id="com<?= $comentario->id ?>">
            <div class="comentario-head">
                <span class="username">
                    <?= $comentario->getUsername() ?> ha respondido:
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
            </div>
        </div>
    <?php endforeach; ?>
    <button type="button" name="ocultar-respuestas" class="btn btn-link">Ocultar</button>
</div>

<?php
$js = <<< JS
$('.comentarios-respuestas').on('click', 'button[name="ocultar-respuestas"]', function () {
    $(this).parent().remove();
});
JS;

$this->registerJs($js);
