<?php
return [
    'id' => 'artchive',
    'name' => 'Artchive',
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
                '<username>/profile' => 'usuarios-completo/view',
                '<username>/profile/modify' => 'usuarios-datos/update',
                'usuarios/index' => 'usuarios-completo/index',
                '<username>/pjs' => 'usuarios-completo/personajes',
                'pj/<id:\d>' => 'personajes/view',
                '<username>/pjs' => 'personajes/index',
                'msg/inbox' => 'mensajes-privados/index',
                'msg/view/<id:\d>' => 'mensajes-privados/view',
                'msg/sent' => 'mensajes-privados/sent',
                'msg/send' => '/mensajes-privados/create',
                'msg/send/<username>' => 'mensajes-privados/create',
                '<username>/followers' => 'seguidores/index',
                '<username>/following' => 'seguidores/following',
            ],

        ],
    ],
];
