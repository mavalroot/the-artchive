<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\Notificaciones;
use common\models\MensajesPrivados;

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
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
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
        ['label' => '<span class="glyphicon glyphicon-home"></span> ' . Yii::t('frontend', 'Inicio'), 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItemsRight[] = [
            'label' => Yii::t('frontend', '¿No tienes cuenta?'),
            'items' => [
                ['label' => Yii::t('frontend', 'Regístrate'), 'url' => ['/site/signup']],
                ['label' => Yii::t('frontend', 'Conéctate'), 'url' => ['/site/login']],
            ],
        ];
    } else {
        $menuItemsLeft[] = ['label' => '<span class="glyphicon glyphicon-bell"></span> ' . Yii::t('frontend', 'Notificaciones') . ' <span class="num-alerts-notis">' . Yii::$app->user->identity->getUnseenAlerts(new Notificaciones(), 'usuario_id') . '</span>', 'url' => ['/notificaciones/index']];
        $menuItemsLeft[] = ['label' => '<span class="glyphicon glyphicon-envelope"></span> ' . Yii::t('frontend', 'Mensajes') . ' <span class="num-alerts-mp">' . Yii::$app->user->identity->getUnseenAlerts(new MensajesPrivados(), 'receptor_id') . '</span>', 'url' => ['/mensajes-privados/index']];
        $menuItemsLeft[] = [
            'label' => '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('frontend', 'Crear'),
            'items' => [
                ['label' => Yii::t('frontend', 'Personaje'), 'url' => ['/personajes/create']],
                ['label' => Yii::t('frontend', 'Publicación'), 'url' => ['/publicaciones/create']],
            ],
        ];
        $menuItemsLeft[] = ['label' => '<i class="glyphicon glyphicon-list-alt"></i> ' . Yii::t('frontend', 'Foro'), 'url' => ['/podium/home']];
        $menuItemsRight[] = [
            'label' => Yii::$app->user->identity->username,
            'items' => [
                ['label' => Yii::t('frontend', 'Ver mi Perfil'), 'url' => ['/usuarios-completo/view', 'username' => Yii::$app->user->identity->username]],
                ['label' => Yii::t('frontend', 'Modificar mi Perfil'), 'url' => ['/usuarios-datos/update', 'username' => Yii::$app->user->identity->username]],
                [
                    'label' => Yii::t('frontend', 'Salir'),
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                 ],
            ],
        ];
    }
    $language = '<span class="navbar-text navbar-right"><div id="change-language">
    <button title="Change language to english" alt="Change language to english" type="button" class="flag-button' . (Yii::$app->language ==  'en-EN' ? ' flag-selected' : '') .
    '" value="en-EN"><span class="flag-icon flag-icon-gb"></span></button>
    <button title="Cambiar idioma a español" alt="Cambiar idioma a español"  type="button" class="flag-button' . (Yii::$app->language ==  'es-ES' ? ' flag-selected' : '') . '" value="es-ES">
    <span class="flag-icon flag-icon-es"></span>
    </button>
    </div></span>';
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
    <?= $language ?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <ul id="w1" class="navbar-nav navbar-right nav">
                   <li>
                      <div class="col-sm-3">
                         <form role="search" action="/search" method="get">
                            <div id="sb-nav">
                               <input class="form-control" placeholder="<?= Yii::t('app', 'Buscar') ?>" name="st" type="text">
                               <select class="btn hidden-sm" name="src">
                                  <option value="user"><?= Yii::t('frontend', 'Usuario') ?></option>
                                  <option value="pj"><?= Yii::t('frontend', 'Personaje') ?></option>
                               </select>
                               <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                         </form>
                      </div>
                   </li>
          </ul>
      <?php endif; ?>
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
<footer id="myFooter">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h2 class="logo"><a href="#"> LOGO </a></h2>
            </div>
            <div class="col-sm-3">
                <h5>Get started</h5>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Sign up</a></li>
                    <li><a href="#">Downloads</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>About us</h5>
                <ul>
                    <li><a href="#">Company Information</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Reviews</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Support</h5>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Help desk</a></li>
                    <li><a href="#">Forums</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> by <a href="http://www.mavalroot.es/">mavalroot</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
