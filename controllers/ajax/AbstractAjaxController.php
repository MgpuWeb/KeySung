<?php

namespace app\controllers\ajax;

use Yii;
use yii\web\Controller;
use yii\web\Response;

abstract class AbstractAjaxController extends Controller
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