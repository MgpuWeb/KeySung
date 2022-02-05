<?php

namespace app\controllers\api;

use Yii;
use yii\web\Controller;
use yii\web\Response;

abstract class AbstractApiController extends Controller
{
	public function behaviors()
	{
		return [
			'authenticator' => [
				'class' => \yii\filters\auth\HttpBearerAuth::class,
			]
		];
	}

	public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
		Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
}