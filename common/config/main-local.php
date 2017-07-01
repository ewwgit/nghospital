<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ngh',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
						'transport' => [
								'class' => 'Swift_SmtpTransport',
								'host' => 'hosting.kameshwarieservices.com',
								'username' => 'ngh@expertwebworx.in',
								'password' => 'P@ssw0rd',
								'port' => '465',
								'encryption' => 'ssl',
						],         
        ],
    ],
];
