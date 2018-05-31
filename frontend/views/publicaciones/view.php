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
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Publicaciones de') . ' ' . $owner, 'url' => ['index', 'username' => $owner]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($usuario->isApto()) : ?>
<div class="publicaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            'created_at:datetime',
            [
                'attribute' => 'contenido',
                'format' => 'html',
                'value' => function ($model) {
                    return Markdown::convert($model->contenido);
                }
            ],
            'updated_at:relativetime',
        ],
    ]) ?>


    <?php $model->getButtons() ?>

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
    $(this).remove();
});
JS;

$this->registerJs($js);
?>
<?php endif; ?>

<h2>No puedes ver esta publicación.</h2>
