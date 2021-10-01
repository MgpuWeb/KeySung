<?php

namespace app\controllers\ajax;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class AbstractAjaxController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }
}