<?php

\Yii::$container->set(
	\app\services\meeting\contract\MeetingServiceInterface::class,
	\app\services\meeting\implementation\rest\Service::class
);