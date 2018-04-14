<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    ?>
    <div class="col-sm-3">
     <form role="search" action="/site/search" method="get">
       <div id="sb-nav">
         <input type="text" class="form-control" placeholder="Buscar" name="st">
         <select class="btn" name="src">
               <option value="user">Usuario</option>
               <option value="pj">Personaje</option>
           </select>
           <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
         </div>
     </form>
   </div>
    <?php
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],

    ];
    $menuItems[] = [
        'label' => 'Depuración',
        'items' => [
            ['label' => 'Usuarios', 'url' => ['/usuarios-completo/index']],
            ['label' => 'Personajes', 'url' => ['/personajes/index']],
            ['label' => 'Publicaciones', 'url' => ['/publicaciones/index']],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Crear',
            'items' => [
                ['label' => 'Personaje', 'url' => ['/personajes/create']],
                ['label' => 'Publicación', 'url' => ['/publicaciones/create']],
            ],
        ];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
        $menuItems[] = [
            'label' => Yii::$app->user->identity->username,
            'items' => [
                ['label' => 'Inbox', 'url' => ['/mensajes/inbox']],
                ['label' => 'Perfil', 'url' => ['/usuarios-completo/view', 'username' => Yii::$app->user->identity->username]],

            ],
        ];
        $menuItems[] = [
            'label' => '<span class="glyphicon glyphicon-bell"></span>',
            'url' => ['/notificaciones/index']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
