<?php
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\UsuariosCompleto */
?>

<div id="profile-content" class="row">
    <div class="col-sm-4">
        <div id="profile-details">
            <?php if ($model->bio) : ?>
                <h5><?= $model->getAttributeLabel('bio') ?></h5>
                <p>
                    <?= Yii::$app->formatter->asText($model->bio) ?>
                </p>
            <?php endif; ?>
            <?php if ($model->aficiones) : ?>
                <h5><?= $model->getAttributeLabel('aficiones') ?></h5>
                <p>
                    <?= Yii::$app->formatter->asText($model->aficiones) ?>
                </p>
            <?php endif; ?>
            <?php if ($model->tematica_favorita) : ?>
                <h5><?= $model->getAttributeLabel('tematica_favorita') ?></h5>
                <p>
                    <?= Yii::$app->formatter->asText($model->tematica_favorita) ?>
                </p>
            <?php endif; ?>
            <?php if ($model->pagina_web) : ?>
                <h5><?= $model->getAttributeLabel('pagina_web') ?></h5>
                <p>
                    <?= Yii::$app->formatter->asUrl($model->pagina_web) ?>
                </p>
            <?php endif; ?>
            <?php if ($model->isSelf()) : ?>
                <h5><?= $model->getAttributeLabel('email') ?></h5>
                <p>
                    <?= Yii::$app->formatter->asEmail($model->email) ?>
                </p>
            <?php endif; ?>
            <?= $model->getCharactersButton() ?>
        </div>
    </div>
    <div class="col-sm-8">
            <?php if ($publicaciones) : ?>
                <?php foreach ($publicaciones as $value) : ?>
                    <?= $this->render('/publicaciones/_publicaciones', ['model' => $value]) ?>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="no-entry">
                    <?= Yii::t('frontend', 'Este usuario no ha hecho ninguna publicación.') ?>
                </div>
            <?php endif; ?>
        <?= LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
    </div>
</div>
