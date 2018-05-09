
<div class="publicacion-comentarios">
    <?php foreach ($comentarios as $comentario): ?>
        <div class="comentario" id="com<?= $comentario->id ?>">
            <div class="comentario-head">
                <span class="permalink-username">
                    <?= $comentario->getPermalink() ?> <?= $comentario->getUsername() ?>
                </span>
                <small>
                    [<?= Yii::$app->formatter->asDateTime($comentario->created_at) ?>]
                </small>
            </div>
            <div class="comentario-botones">
                <input class="btn btn-sm" type="button" name="responder-comentario" value="Responder">
                <!-- Editar / Borrar / Responder -->
            </div>
            <div class="comentario-body">
                <div class="quote">
                    <?= $comentario->getRespuestaUrl() ?>
                </div>
                <div class="contenido">
                    <?= Yii::$app->formatter->asnText($comentario->contenido) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="nuevo-comentario">
        <h3>Publicar comentario</h3>
        <form name="nuevo-comentario" method="post">
            <textarea name="name" class="form-control" rows="5"></textarea>
            <input type="button" class="btn btn-success" value="Enviar">
        </form>
    </div>
</div>
