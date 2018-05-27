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
            <?= $model->getMpButton() ?>
            <?= $model->getBlockButton() ?>
        </div>
        <div class="nav-follow">
            <ul>
                <li>
                    <h4>
                    <?= Html::a($model->getAttributeLabel('seguidores') . '<small>' . $model->seguidores . '</small>', [
                        'seguidores/index', 'username' => $model->username
                        ]) ?>
                    </h4>
                </li>
                <li>
                    <h4>
                    <?= Html::a($model->getAttributeLabel('siguiendo') . '<small>' . $model->siguiendo . '</small>', [
                        'seguidores/following', 'username' => $model->username
                        ]) ?>
                    </h4>
                </li>
                <li>
                <?= $model->getFollowButtons() ?>
                </li>
            </ul>
        </div>
    </div>
    <?php if ($model->status == User::STATUS_DELETED) : ?>
        <h4><?= Yii::t('frontend', 'Este usuario ha sido eliminado.') ?></h4>
    <?php elseif ($model->status == User::STATUS_BANNED) : ?>
        <h4><?= Yii::t('frontend', 'Este usuario ha sido baneado.') ?></h4>
    <?php elseif ($model->status == User::STATUS_WAITING) : ?>
        <h4><?= Yii::t('frontend', 'Este usuario aún no ha confirmado su cuenta.') ?></h4>
    <?php elseif ($model->isBlocked()) : ?>
        <h4><?= Yii::t('frontend', 'Este usuario ha sido bloqueado por usted.') ?></h4>
    <?php elseif ($model->imBlocked()) : ?>
        <h4><?= Yii::t('frontend', 'Este usuario le ha bloqueado.') ?></h4>
    <?php else : ?>
        <?= $this->render('_profile', [
            'model' => $model,
            'publicaciones' => $publicaciones,
            'pagination' => $pagination,
        ]) ?>
    <?php endif; ?>
</div>


<?php
$js = <<< JS
actionButton('/usuarios-completo/follow', 'follow', '#member-profile', '.nav-follow');
actionButton('/usuarios-completo/unfollow','unfollow', '#member-profile', '.nav-follow');
actionButton('/usuarios-completo/block', 'block', '#member-profile', '#member-profile');
actionButton('/usuarios-completo/unblock', 'unblock', '#member-profile', '#member-profile');
JS;

$this->registerJs($js);
