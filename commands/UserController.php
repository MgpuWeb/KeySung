<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class UserController extends Controller
{
	public function actionCreate(string $email = 'testUser@email.ru', string $password = 'testPassword')
	{
		$user = new User([
			'email' => $email,
			'password' => \Yii::$app->getSecurity()->generatePasswordHash($password),
			'access_token' => \Yii::$app->security->generateRandomString(),
		]);

		$user->save();

		return ExitCode::OK;
	}
}