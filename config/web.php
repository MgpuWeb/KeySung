<?php

use yii\web\JsonParser;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru_RU',
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
			'enableSession'   => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            'useFileTransport' => true,
//            'useFileTransport' => false,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'encryption' => 'tls',
//                'host' => 'your_mail_server_host',
//                'port' => 'your_smtp_port',
//                'username' => 'your_username',
//                'password' => 'your_password',
//            ],
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
                // site
                'GET site/login' => 'site/login',
                'GET site/signup' => 'site/sign-up-view',
                'POST site/signup' => 'site/sign-up',

                // meetings
                'GET meetings' => 'meetings/collection',
                'OPTIONS meetings' => 'meetings/options',
				'GET meetings/<id:\w+>' => 'meetings/view',
				'OPTIONS meetings/<id:\w+>' => 'meetings/options',
                'GET meetings/<id:\w+>/summary' => 'meetings/summary',
                'OPTIONS meetings/<id:\w+>/summary' => 'meetings/options',

                // api/common
                'POST api/auth/login' => 'api/common/auth/login',
                'OPTIONS api/auth/login' => 'api/common/auth/options',

				'POST api/meetings' => 'api/common/meetings/create',
				'GET api/meetings/<id:\w+>' => 'api/common/meetings/view',
				'OPTIONS api/meetings/<id:\w+>' => 'api/common/meetings/options',
                'GET api/meetings/<id:\w+>/summary' => 'api/common/meetings/summary',
                'OPTIONS api/meetings/<id:\w+>/summary' => 'api/common/meetings/options',
                'GET api/meetings' => 'api/common/meetings/collection',
                'OPTIONS api/meetings' => 'api/common/meetings/options',

				// api/integration
				'POST api/integration/meetings' => 'api/integration/meetings/create',
                'OPTIONS api/integration/meetings' => 'api/integration/meetings/options',
				'GET api/integration/meetings' => 'api/integration/meetings/collection',
				'PUT api/integration/meetings/<id:\w+>' => 'api/integration/meetings/update',
                'OPTIONS api/integration/meetings/<id:\w+>' => 'api/integration/meetings/options',
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
