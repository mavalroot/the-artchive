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
        'brandLabel' => false,
        'brandUrl' => false,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItemsLeft = [
        ['label' => '<span class="glyphicon glyphicon-home"></span> Inicio', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItemsRight[] = [
            'label' => '¿No tienes cuenta?',
            'items' => [
                ['label' => 'Signup', 'url' => ['/site/signup']],
                ['label' => 'Login', 'url' => ['/site/login']],
            ],
        ];
    } else {
        $menuItemsLeft[] = ['label' => '<span class="glyphicon glyphicon-bell"></span> Notificaciones <span class="num-alerts">' . Yii::$app->user->identity->getUnseenAlerts() . '</span>', 'url' => ['/notificaciones/index']];
        $menuItemsLeft[] = ['label' => '<span class="glyphicon glyphicon-envelope"></span> Mensajes', 'url' => ['/mensajes-privados/index']];
        $menuItemsLeft[] = [
            'label' => '<span class="glyphicon glyphicon-pencil"></span> Crear',
            'items' => [
                ['label' => 'Personaje', 'url' => ['/personajes/create']],
                ['label' => 'Publicación', 'url' => ['/publicaciones/create']],
            ],
        ];
        $menuItemsRight[] = [
            'label' => Yii::$app->user->identity->username,
            'items' => [
                ['label' => 'Ver mi Perfil', 'url' => ['/usuarios-completo/view', 'username' => Yii::$app->user->identity->username]],
                ['label' => 'Modificar mi Perfil', 'url' => ['/usuarios-datos/update', 'username' => Yii::$app->user->identity->username]],
                [
                    'label' => 'Logout',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                 ],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => $menuItemsLeft,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $menuItemsRight,
    ]);
    ?>
    <ul id="w1" class="navbar-nav navbar-right nav">
               <li>
                  <div class="col-sm-3">
                     <form role="search" action="/search" method="get">
                        <div id="sb-nav">
                           <input class="form-control" placeholder="Buscar" name="st" type="text">
                           <select class="btn hidden-sm" name="src">
                              <option value="user">Usuario</option>
                              <option value="pj">Personaje</option>
                           </select>
                           <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                     </form>
                  </div>
               </li>
      </ul>
    <?php
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
        <p class="pull-right">by <a href="http://www.mavalroot.es/">mavalroot</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
