<?php
use kartik\markdown\Markdown;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Personajes */
?>

<div class="personaje">
    <div class="personaje-header">
        <div class="user">
            <div class="avatar">
                <?= Html::a($usuario->getImgAvatar(), ['/usuarios-completo/view', 'username' => $usuario->username])  ?>
            </div>
        </div>
        <div class="nombre">
            <h2><?= Html::a(Yii::$app->formatter->asText($model->nombre), $model->getRawUrl()); ?></h2>
        </div>
        <small><?= Yii::$app->formatter->asDateTime($model->created_at) ?></small>
    </div>
    <div class="personaje-body">
        <?php if ($model->getButtons()) : ?>
            <div class="buttons">
                <?= $model->getButtons() ?>
            </div>
        <?php endif; ?>
        <?php if ($model->fecha_nac) : ?>
            <h3><?= $model->getAttributeLabel('fecha_nac') ?></h3>
            <div class="contenido-grande">
                <?= Yii::$app->formatter->asDate($model->fecha_nac) ?>
            </div>
        <?php endif; ?>
        <?php if ($model->historia) : ?>
            <h3><?= $model->getAttributeLabel('historia') ?></h3>
            <div class="contenido-grande">
                <?= Yii::$app->formatter->asHtml(Markdown::convert($model->historia)) ?>
            </div>
        <?php endif; ?>
        <?php if ($model->personalidad) : ?>
            <h3><?= $model->getAttributeLabel('personalidad') ?></h3>
            <div class="contenido-grande">
                <?= Yii::$app->formatter->asHtml(Markdown::convert($model->personalidad)) ?>
            </div>
        <?php endif; ?>
        <?php if ($model->apariencia) : ?>
            <h3><?= $model->getAttributeLabel('apariencia') ?></h3>
            <div class="contenido-grande">
                <?= Yii::$app->formatter->asHtml(Markdown::convert($model->apariencia)) ?>
            </div>
        <?php endif; ?>
        <?php if ($model->hechos_destacables) : ?>
            <h3><?= $model->getAttributeLabel('hechos_destacables') ?></h3>
            <div class="contenido-grande">
                <?= Yii::$app->formatter->asHtml(Markdown::convert($model->hechos_destacables)) ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="personaje-footer">
        <div class="updated">
            <i class="fas fa-edit"></i> <?= Yii::$app->formatter->asRelativeTime($model->updated_at) ?>
        </div>
        <div class="export">
            <?= $model->getExportButton() ?>
        </div>
        <div class="relacion">
            <?php if ($model->isMine()) : ?>
                <?= Html::a('<i class="fas fa-user-friends"></i> ' . Yii::t('frontend', 'Añadir relación'), ['relaciones/create', 'id' => $model->id]) ?>
            <?php endif; ?>
        </div>
    </div>
</div>
