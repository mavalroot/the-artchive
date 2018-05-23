<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\markdown\Markdown;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */
?>

<div id="profile-content" class="row">
    <div class="col-sm-3">
        <div id="profile-details">
            <?php if ($model->bio) : ?>
                <h5>Sobre mi</h5>
                <p>
                    <?= Yii::$app->formatter->asText($model->bio) ?>
                </p>
            <?php endif; ?>
            <?php if ($model->aficiones) : ?>
                <h5>Aficiones</h5>
                <p>
                    <?= Yii::$app->formatter->asText($model->aficiones) ?>
                </p>
            <?php endif; ?>
            <?php if ($model->tematica_favorita) : ?>
                <h5>Temática favorita</h5>
                <p>
                    <?= Yii::$app->formatter->asText($model->tematica_favorita) ?>
                </p>
            <?php endif; ?>
            <?php if ($model->pagina_web) : ?>
                <h5>Página web</h5>
                <p>
                    <?= Yii::$app->formatter->asUrl($model->pagina_web) ?>
                </p>
            <?php endif; ?>
            <?php if ($model->isSelf()) : ?>
                <h5>Mi correo</h5>
                <p>
                    <?= Yii::$app->formatter->asEmail($model->email) ?>
                </p>
            <?php endif; ?>
            <?= $model->getCharactersButton() ?>
        </div>
    </div>
    <div class="col-sm-9">
        <div id="profile-entries">
            <h2>Publicaciones</h2>
            <?php if ($publicaciones) : ?>
                <?php foreach ($publicaciones as $value) : ?>
                    <div class="entry">
                        <h4><?= Yii::$app->formatter->asText($value->titulo) ?> <small><?= Yii::$app->formatter->asDateTime($value->created_at) ?></small></h4>
                        <div class="content">
                            <?= StringHelper::truncate(Yii::$app->formatter->asHtml(Markdown::convert($value->contenido)), 140) ?> <br />
                            <?= Html::a('[Seguir leyendo]', ['publicaciones/view', 'id' => $value->id]) ?><br />
                            <?= $value->numcom ?> <i class="glyphicon glyphicon-comment"></i>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="entry">
                    <p>
                        Este usuario no ha hecho ninguna publicación.
                    </p>
                </div>
            <?php endif; ?>
        </div>
        <?= LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
    </div>
</div>
