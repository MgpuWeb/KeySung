<?php

namespace app\controllers\api;

use Yii;
use yii\filters\Cors;
use yii\web\Controller;
use yii\web\Response;

abstract class AbstractApiController extends Controller
{
	public function behaviors()
	{
		return [
			'authenticator' => [
				'class' => \yii\filters\auth\HttpBearerAuth::class,
			],
		];
	}

	public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
		Yii::$app->request->enableCsrfValidation = false;

        $headers = Yii::$app->response->headers;
        $headers->set('Access-Control-Allow-Origin', '*');
        $headers->set('Access-Control-Max-Age', 3600);
        $headers->set('Access-Control-Allow-Methods', 'GET, OPTIONS, POST, DELETE, PUT, HEAD, PATCH');

        parent::beforeAction($action);
    }
}