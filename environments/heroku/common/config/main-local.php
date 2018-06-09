<?php

$DATABASE_URL = parse_url(getenv("DATABASE_URL"));

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=' . $DATABASE_URL["host"] . ';port=' . $DATABASE_URL["port"] . ';dbname=' . ltrim($DATABASE_URL["path"], "/"),
            'username' => $DATABASE_URL["user"],
            'password' => $DATABASE_URL["pass"],
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'theartchiveapp@gmail.com',
                'password' => getenv('SMTP_PASS'),
                'port' => '587',
                // 'encryption' => 'tls',
            ],
            'useFileTransport' => false,
        ],
    ],
];
