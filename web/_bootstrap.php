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