<?php
use yii\grid\GridView;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */
//
// $this->title = $model->username;
// $this->params['breadcrumbs'][] = $this->title;
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
            <?= Html::a('Mandar MP', ['/mensajes-privados/create', 'username' => $model->username], ['class' => 'btn btn-md btn-info']) ?>
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
                <?php if (!$model->isSelf() && $model->siguiendo()) : ?>
                <form name="unfollow" method="post">
                    <input type="hidden" name="id" value="<?= $model->id ?>">
                    <button type="submit" class="btn btn-sm btn-secondary">Dejar de seguir</button>
                </form>
                <?php elseif (!$model->isSelf() && !$model->siguiendo()) : ?>
                <form name="follow" method="post">
                    <input type="hidden" name="id" value="<?= $model->id ?>">
                        <button type="submit" class="btn btn-sm btn-primary">Seguir</button>
                    </form>
                <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    <div id="profile-content" class="row">
        <div id="profile-details" class="col-sm-4">
            <h5>Bio</h5>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
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
                    <?= $model->pagina_web ?>
                </p>
            <?php endif; ?>
            <?php if ($model->isSelf()): ?>
                <h5>Mi correo</h5>
                <p>
                    <?= $model->email ?>
                </p>
            <?php endif; ?>
            <?= Html::a('Ver personajes', ['personajes/index', 'username' => $model->username], ['class' => 'btn btn-success']) ?>
        </div>
        <div id="profile-entries" class="col-sm-8">
            <h2>Publicaciones</h2>
            <?php if ($model->getPublicaciones()->all()): ?>
                <?php foreach ($model->getPublicaciones()->all() as $value): ?>
                    <div class="entry">
                        <p>
                            <h4><?= $value->titulo ?> <small><?= Yii::$app->formatter->asDateTime($value->created_at) ?></small></h4>
                            <?= Yii::$app->formatter->asnText($value->contenido) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <p>
                        Este usuario no ha hecho ninguna publicación.
                    </p>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php
$js = <<< JS
actionButton('follow', '#member-profile', '.nav-follow');
actionButton('unfollow', '#member-profile', '.nav-follow');
actionButton('block', '#member-profile', '#member-profile');
actionButton('unblock', '#member-profile', '#member-profile');
JS;

$this->registerJs($js);
