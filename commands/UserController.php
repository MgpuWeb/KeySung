<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class UserController extends Controller
{
	public function actionCreate(string $email = 'testUser@email.ru', string $password = 'testPassword')
	{
	    $accessToken = \Yii::$app->security->generateRandomString();
		$user = new User([
			'email' => $email,
			'password' => \Yii::$app->getSecurity()->generatePasswordHash($password),
			'access_token' => $accessToken,
		]);

		$user->save();

		$this->stdout("Email: $email\n", Console::BOLD);
		$this->stdout("Password: $password\n", Console::BOLD);
		$this->stdout("Access Token: $accessToken\n", Console::BOLD);

		return ExitCode::OK;
	}
}