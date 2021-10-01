<?php

namespace app\controllers;

use yii\web\Controller;

class MeetingsController extends Controller
{
    public function actionView(string $id)
    {
        return $this->render('view', [
        	'meeting' => [
        		'id' => $id,
				'participants' => [
					$this->createRandomDataParticipant(1),
					$this->createRandomDataParticipant(2),
					$this->createRandomDataParticipant(3),
					$this->createRandomDataParticipant(4),
					$this->createRandomDataParticipant(5),
					$this->createRandomDataParticipant(6),
				]
			],
		]);
    }

    private function createRandomDataParticipant(int $id): array
	{
		return [
			'id' => $id,
			'isInvolved' => random_int(0, 1)  ? 'Да' : 'Нет',
			'emotion' => ["Нейтральный(ая)", "Радостный(ая)", "Грустный(ая)", "Удивлённый(ая)", "Злой(ая)"][random_int(0, 4)]
		];
	}

}
