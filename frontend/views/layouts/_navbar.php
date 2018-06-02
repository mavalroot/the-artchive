<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

use common\models\Notificaciones;
use common\models\MensajesPrivados;

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
$language ?>
<?php if (!Yii::$app->user->isGuest) : ?>
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
