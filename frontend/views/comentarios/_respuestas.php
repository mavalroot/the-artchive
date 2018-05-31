<div class="comentarios-respuestas">
    <?php foreach ($comentarios as $comentario) : ?>
        <?= $this->render('_respuesta.php', [
            'comentario' => $comentario
            ]) ?>
    <?php endforeach; ?>

</div>
