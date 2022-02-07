<?php

namespace app\controllers;

use app\models\api\common\swagger\Meeting;
use app\models\User;
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
		$meeting = Yii::$app->runAction("/ajax/meetings/view", ['id' => $id]);
		Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('view', [
        	'meeting' => $meeting
		]);
    }
}
