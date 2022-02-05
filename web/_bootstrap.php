<?php

Yii::$container->set(
	\app\services\meeting\contract\MeetingServiceInterface::class,
	\app\services\meeting\implementation\rest\Service::class
);

Yii::$container->setDefinitions([
	\app\services\meeting\implementation\rest\Client::class => static function(): \app\services\meeting\implementation\rest\Client {
		return new \app\services\meeting\implementation\rest\Client([
			'base_uri' => Yii::$app->params['services']['emotions']['base_url'],
		]);
	},
]);

// user service
Yii::$container->set(
    \app\services\user\contract\UserServiceInterface::class,
    \app\services\user\implementation\Service::class
);
Yii::$container->set(
    \app\services\user\contract\UserRepositoryInterface::class,
    \app\services\user\implementation\Repository::class
);

// email service
Yii::$container->set(
    \app\services\email\contract\EmailServiceInterface::class,
    \app\services\email\implementation\Service::class
);
