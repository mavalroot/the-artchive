<?php
return [
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'controllerMap' => [
        'heroku' => [
            'class' => 'purrweb\heroku\HerokuGeneratorController',
        ],
    ],
];
