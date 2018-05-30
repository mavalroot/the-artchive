<div class="comentarios-respuestas">
    <?php foreach ($comentarios as $comentario) : ?>
        <?= $this->render('_respuesta.php', [
            'comentario' => $comentario
            ]) ?>
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
