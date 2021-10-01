<?php

namespace app\controllers;

use yii\web\Controller;

/** @todo: сделать рендеринг данных через pjax */
class MeetingsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView(string $id)
    {
        return $this->render('view');
    }

}
