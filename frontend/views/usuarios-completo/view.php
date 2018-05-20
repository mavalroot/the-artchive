<?php
use yii\helpers\Html;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */
?>

<div id="member-profile">
    <div id="top-bar">
        <div class="avatar">
            <?php if ($model->avatar) : ?>
                <img src="<?= $model->avatar ?>" />
                <?php else : ?>
                    <img src="/uploads/default.jpg" />
            <?php endif; ?>
        </div>
        <div class="user">
            <h1 class="user-username"><?= $model->username ?></h1>
            <?php if (!$model->isSelf() && !$model->isBlocked() && !$model->imBlocked()) : ?>
                <?= Html::a('Mandar MP', ['/mensajes-privados/create', 'username' => $model->username], ['class' => 'btn btn-md btn-info']) ?>
            <?php endif; ?>
            <?= $model->getBlockButton() ?>
        </div>
        <div class="nav-follow">
            <ul>
                <li><h4>Seguidores <small><?= $model->seguidores ?></small></h4></li>
                <li><h4>Siguiendo <small><?= $model->siguiendo ?></small></h4></li>
                <li>
                <?php if (!$model->isSelf() && $model->siguiendo() && !$model->isBlocked() && !$model->imBlocked()) : ?>
                    <form name="unfollow" method="post">
                        <input type="hidden" name="id" value="<?= $model->id ?>">
                        <button type="submit" class="btn btn-sm btn-secondary">Dejar de seguir</button>
                    </form>
                <?php elseif (!$model->isSelf() && !$model->siguiendo() && !$model->isBlocked() && !$model->imBlocked()) : ?>
                    <form name="follow" method="post">
                        <input type="hidden" name="id" value="<?= $model->id ?>">
                        <button type="submit" class="btn btn-sm btn-primary">Seguir</button>
                    </form>
                <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
    <?php if ($model->status == User::STATUS_DELETED) : ?>
        <h4>Este usuario ha sido eliminado.</h4>
    <?php elseif ($model->status == User::STATUS_BANNED) : ?>
        <h4>Este usuario ha sido baneado.</h4>
    <?php elseif ($model->status == User::STATUS_WAITING) : ?>
        <h4>Este usuario no ha confirmado su correo.</h4>
    <?php elseif ($model->isBlocked()) : ?>
        <h4>Este usuario ha sido bloqueado por usted. No podrá enviar ni recibir mensajes, ni verá su actividad.</h4>
    <?php elseif ($model->imBlocked()) : ?>
        <h4>Este usuario le ha bloqueado. No podrá enviar ni recibir mensajes, ni verá su actividad.</h4>
    <?php else : ?>
        <?= $this->render('_profile', [
            'model' => $model,
        ]) ?>
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
