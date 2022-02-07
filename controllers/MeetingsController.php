<?php

namespace app\controllers;

use app\models\User;
use app\models\api\common\swagger\Meeting;
use app\models\api\common\swagger\MeetingSummary;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class MeetingsController extends Controller
{
    public function actionView(string $id)
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;
        Yii::$app->request->headers->set('Authorization', "Bearer {$user->getAccessToken()}");

        /** @var ?Meeting $meeting */
		$meeting = Yii::$app->runAction("/api/common/meetings/view", ['id' => $id]);
		Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('view', [
        	'meeting' => $meeting
		]);
    }

    public function actionSummary(string $id)
    {
        /** @var User $user */
        $user = Yii::$app->user->identity;
        Yii::$app->request->headers->set('Authorization', "Bearer {$user->getAccessToken()}");

        /** @var ?MeetingSummary $meetingSummary */
        $meetingSummary = Yii::$app->runAction("/api/common/meetings/summary", ['id' => $id]);
        Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('summary', [
            'meetingSummary' => $meetingSummary
        ]);
    }

    public function actionCollection()
    {
        $searchModel = new \app\models\search\MeetingItem();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('collection', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
}
