<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\markdown\Markdown;
use common\models\UsuariosCompleto;

/* @var $this yii\web\View */
/* @var $model common\models\Publicaciones */

$usuario = UsuariosCompleto::findOne(['id' => $model->usuario_id]);
$owner = $usuario->username;

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => $owner, 'url' => ['/usuarios-completo/view', 'username' => $owner]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($usuario->isApto()) : ?>
<div class="publicaciones-view">

    <?php $model->getButtons() ?>

    <?= $this->render('_publicaciones.php', ['model' => $model]) ?>

    <?= $this->render('/comentarios/_comentarios', [
        'comentarios' => $comentarios,
        'publicacion' => $model->id,
        'pagination' => $pagination,
        'respuesta' => false,
    ]) ?>

</div>

<?php
$crear = Yii::$app->request->baseUrl . '/comentarios/create';
$responder = Yii::$app->request->baseUrl . '/comentarios/responder';
$eliminar = Yii::$app->request->baseUrl . '/comentarios/delete';

$js = <<< JS
publicar("$crear");
responder("$responder");
eliminar("$eliminar");
mostrarRespuestas();
publicarRespuesta("$crear");

$('body').on('click', 'textarea[name="Comentarios[contenido]"]', function () {
    $('textarea[name="Comentarios[contenido]"]').remainingCharacters({
        label: {
            tag: 'p',
            id: 'char-counter',
        },
    });
});

$('body').on('click', 'button[name="ocultar-respuestas"]', function () {
    $(this).closest('.comentario').find('.comentarios-respuestas').remove();
    $(this).closest('.comentario').find('.no-respuestas').remove();
    $(this).remove();
});
JS;

$this->registerJs($js);
?>
<?php else : ?>
<h2>No puedes ver esta publicación.</h2>
<?php endif; ?>
