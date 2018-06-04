<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
    require __DIR__ . '/container.php'
);

return [
    'modules' => [
        /* other modules */
        'markdown' => [
            'class' => 'kartik\markdown\Module',
        ],
        'podium' => [
            'class' => 'bizley\podium\Podium',
            'userComponent' => '\common\models\User',
            'adminId' => 1,
        ],
    ],
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'podium', 'cookieLanguageSelector'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'cookieLanguageSelector' => [
            'class' => 'gugglegum\Yii2\Extension\CookieLanguageSelector\Component',
            'defaultLanguage' => 'es-ES',
            'validLanguages' => ['en-EN', 'es-ES'],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
