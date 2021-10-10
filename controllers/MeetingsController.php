<?php

namespace app\controllers;

use app\models\ajax\Meeting;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class MeetingsController extends Controller
{
    public function actionView(string $id)
    {
    	/** @var Meeting $meeting */
		$meeting = Yii::$app->runAction("/ajax/meetings/view", ['id' => $id]);
		Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('view', [
        	'meeting' => $meeting
		]);
    }
}
