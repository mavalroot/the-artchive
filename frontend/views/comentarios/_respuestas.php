<?php
/* @var $this yii\web\View */
/* @var $comentarios array de common\models\Comentarios */
?>

<div class="comentarios-respuestas">
    <?php foreach ($comentarios as $comentario) : ?>
        <?= $this->render('_comentario', [
            'comentario' => $comentario,
            'respuesta' => true,
            ]) ?>
    <?php endforeach; ?>
</div>
