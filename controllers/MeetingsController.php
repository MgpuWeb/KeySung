<?php

namespace app\controllers;

use app\models\api\common\swagger\Meeting;
use app\models\User;
use app\models\ajax\Meeting;
use app\models\ajax\MeetingItem;
use app\models\ajax\MeetingSummary;
use Yii;
use yii\data\ArrayDataProvider;
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
		$meeting = Yii::$app->runAction("/ajax/meetings/view", ['id' => $id]);
		Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('view', [
        	'meeting' => $meeting
		]);
    }

    public function actionSummary(string $id)
    {
        /** @var ?MeetingSummary $meetingSummary */
        $meetingSummary = Yii::$app->runAction("/ajax/meetings/summary", ['id' => $id]);
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
