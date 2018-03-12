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
                'usuario/ver' => 'usuarios-completo/view',
                'usuario/modificar' => 'usuarios-datos/update',
                'usuarios/index' => 'usuarios-completo/index',
                'usuarios/personajes' => 'usuarios-completo/personajes',
            ],

        ],
    ],
];
