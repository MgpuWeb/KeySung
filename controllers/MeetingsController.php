<?php

namespace app\controllers;

use app\models\ajax\Meeting;
use app\models\ajax\MeetingSummary;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class MeetingsController extends Controller
{
    public function actionView(string $id)
    {
    	/** @var ?Meeting $meeting */
		$meeting = Yii::$app->runAction("/ajax/meetings/view", ['id' => $id]);
		Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('view', [
        	'meeting' => $meeting
		]);
    }

    public function actionSummary(string $id)
    {
        /** @var ?MeetingSummary $meeting */
        $meetingSummary = Yii::$app->runAction("/ajax/meetings/summary", ['id' => $id]);
        Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('summary', [
            'meetingSummary' => $meetingSummary
        ]);
    }
}
