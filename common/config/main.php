<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
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
                '<alias:\w+>' => 'site/<alias>',
                'u/<username>' => 'usuarios-completo/view',
                'usuario/modificar/<username>' => 'usuarios-datos/update',
                'usuarios/index' => 'usuarios-completo/index',
                'u/<username>/pjs' => 'usuarios-completo/personajes',
                'pj/<id:\d>' => 'personajes/view',
                'mensajes/inbox' => 'mensajes-privados/index',
                'mensajes/view/<id:\d>' => 'mensajes-privados/view',
                'mensajes/sent' => 'mensajes-privados/sent',
                '<username>/followers' => 'seguidores/index',
            ],

        ],
    ],
];
