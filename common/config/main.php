<?php
return [
    'id' => 'artchive',
    'name' => 'Artchive',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'sourceLanguage' => 'es-ES',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Hide index.php
            'showScriptName' => false,
            // Use pretty URLs
            'enablePrettyUrl' => true,
            'rules' => [
                // '<alias:\w+>' => 'site/<alias>',
                '/' => 'site/index',
                'login' => 'site/login',
                'about' => 'site/about',
                'about' => 'site/about',
                'error' => 'site/error',
                'contact' => 'site/contect',
                'signup' => 'site/signup',
                'request-reset-password' => 'site/request-password-reset',
                'reset-password' => 'site/password-reset',
                'search' => 'search/search',
                'alerts' => 'notificaciones/index',
                'delete-account' => 'delete-account/index',
                'usuarios/index' => 'usuarios-completo/index',
                'pj/<id:\d>' => 'personajes/view',
                'inbox' => 'mensajes-privados/index',
                'inbox/view/<id:\d>' => 'mensajes-privados/view',
                'inbox/sent' => 'mensajes-privados/sent',
                'inbox/send' => '/mensajes-privados/create',
                'inbox/send/<username>' => 'mensajes-privados/create',
                'create/pj' => 'personajes/create',
                'create/art' => 'publicaciones/create',
                '<username>/modify' => 'usuarios-datos/update',
                '<username>/pjs' => 'personajes/index',
                '<username>/followers' => 'seguidores/index',
                '<username>/following' => 'seguidores/following',
                '<username>' => 'usuarios-completo/view',
            ],

        ],
    ],
];
