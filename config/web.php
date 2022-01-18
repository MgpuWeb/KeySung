<?php

use yii\web\JsonParser;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
			'parsers' => [
				'application/json' => JsonParser::class,
			],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'LT187Ohj5MpViIbcyXCI0N8eufucD48z',
        ],
		'authManager' => [
			'class' => \yii\rbac\DbManager::class,
		],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'user' => [
            'identityClass'   => \app\models\User::class,
            'enableAutoLogin' => true,
			'enableSession'   => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				'GET meetings/<id:\w+>' => 'meetings/view',
				'GET ajax/meetings/<id:\w+>' => 'ajax/meetings/view',
				'POST ajax/meetings' => 'ajax/meetings/create',

				// integration
				'POST integration/meetings' => 'integration/meetings/create',
				'GET integration/meetings' => 'integration/meetings/collection',
				'PUT integration/meetings/<id:\w+>' => 'integration/meetings/update',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
		'traceLine' => '<a href="phpstorm://open?url={file}&line={line}">{file}:{line}</a>',
		'panels' => [
			'queue' => \yii\debug\Panel::class
		],
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
