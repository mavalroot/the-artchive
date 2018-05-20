<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */
?>

<div id="member-profile">
    <div id="top-bar">
        <div class="avatar">
            <?php if ($model->avatar): ?>
                <img src="<?= $model->avatar ?>" />
                <?php else: ?>
                    <img src="/uploads/default.jpg" />
            <?php endif; ?>
        </div>
        <div class="user">
            <h1 class="user-username"><?= $model->username ?></h1>
            <?php if (!$model->isSelf() && !$model->isBlocked()): ?>
                <?= Html::a('Mandar MP', ['/mensajes-privados/create', 'username' => $model->username], ['class' => 'btn btn-md btn-info']) ?>
            <?php endif; ?>
            <?php if (!$model->isSelf() && $model->isBlocked()) : ?>
                <form name="unblock" method="post">
                    <input type="hidden" name="id" value="<?= $model->id ?>">
                    <button type="submit" class="btn btn-sm btn-primary">Desbloquear</button>
                </form>
            <?php elseif (!$model->isSelf() && !$model->isBlocked()) : ?>
                <form name="block" method="post">
                    <input type="hidden" name="id" value="<?= $model->id ?>">
                    <button type="submit" class="btn btn-sm btn-primary">Bloquear</button>
                </form>
            <?php endif; ?>
        </div>
        <div class="nav-follow">
            <ul>
                <li><h4>Seguidores <small><?= $model->seguidores ?></small></h4></li>
                <li><h4>Siguiendo <small><?= $model->siguiendo ?></small></h4></li>
                <li>
                <?php if (!$model->isSelf() && $model->siguiendo() && !$model->isBlocked()) : ?>
                <form name="unfollow" method="post">
                    <input type="hidden" name="id" value="<?= $model->id ?>">
                    <button type="submit" class="btn btn-sm btn-secondary">Dejar de seguir</button>
                </form>
            <?php elseif (!$model->isSelf() && !$model->siguiendo() && !$model->isBlocked()) : ?>
                <form name="follow" method="post">
                    <input type="hidden" name="id" value="<?= $model->id ?>">
                        <button type="submit" class="btn btn-sm btn-primary">Seguir</button>
                    </form>
                <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    <?php if ($model->isBlocked()): ?>
        <h4>Este usuario ha sido bloqueado por usted. No podrá enviar ni recibir mensajes, ni verá su actividad.</h4>
    <?php else: ?>
        <div id="profile-content" class="row">
            <div class="col-sm-3">
                <div id="profile-details">
                    <?php if ($model->bio): ?>
                        <h5>Sobre mi</h5>
                        <p>
                            <?= $model->bio ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($model->aficiones): ?>
                        <h5>Aficiones</h5>
                        <p>
                            <?= $model->aficiones ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($model->tematica_favorita): ?>
                        <h5>Temática favorita</h5>
                        <p>
                            <?= $model->tematica_favorita ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($model->pagina_web): ?>
                        <h5>Página web</h5>
                        <p>
                            <?= Yii::$app->formatter->asUrl($model->pagina_web) ?>
                        </p>
                    <?php endif; ?>
                    <?php if ($model->isSelf()): ?>
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
                    <?php if ($model->getPublicaciones()->all()): ?>
                        <?php foreach ($model->getPublicaciones()->all() as $value): ?>
                            <div class="entry">
                                <h4><?= $value->titulo ?> <small><?= Yii::$app->formatter->asDateTime($value->created_at) ?></small></h4>
                                <p>
                                    <?= StringHelper::truncate(Yii::$app->formatter->asnText($value->contenido), 140) ?> <br />
                                    <?= Html::a('[Seguir leyendo]', ['publicaciones/view', 'id' => $value->id]) ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="entry">
                            <p>
                                Este usuario no ha hecho ninguna publicación.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>


<?php
$js = <<< JS
actionButton('follow', '#member-profile', '.nav-follow');
actionButton('unfollow', '#member-profile', '.nav-follow');
actionButton('block', '#member-profile', '#member-profile');
actionButton('unblock', '#member-profile', '#member-profile');
JS;

$this->registerJs($js);
