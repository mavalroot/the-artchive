<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */
?>

<div id="profile-content" class="row">
    <div class="col-sm-3">
        <div id="profile-details">
            <?php if ($model->bio) : ?>
                <h5>Sobre mi</h5>
                <p>
                    <?= $model->bio ?>
                </p>
            <?php endif; ?>
            <?php if ($model->aficiones) : ?>
                <h5>Aficiones</h5>
                <p>
                    <?= $model->aficiones ?>
                </p>
            <?php endif; ?>
            <?php if ($model->tematica_favorita) : ?>
                <h5>Temática favorita</h5>
                <p>
                    <?= $model->tematica_favorita ?>
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
            <p class="text-center"><?= Html::a('Ver personajes', ['personajes/index', 'username' => $model->username], ['class' => 'btn btn-success']) ?></p>
        </div>
    </div>
    <div class="col-sm-9">
        <div id="profile-entries">
            <h2>Publicaciones</h2>
            <?php if ($model->getPublicaciones()->all()) : ?>
                <?php foreach ($model->getPublicaciones()->all() as $value) : ?>
                    <div class="entry">
                        <h4><?= $value->titulo ?> <small><?= Yii::$app->formatter->asDateTime($value->created_at) ?></small></h4>
                        <p>
                            <?= StringHelper::truncate(Yii::$app->formatter->asnText($value->contenido), 140) ?> <br />
                            <?= Html::a('[Seguir leyendo]', ['publicaciones/view', 'id' => $value->id]) ?>
                        </p>
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
    </div>
</div>
