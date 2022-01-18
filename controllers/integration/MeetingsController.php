<?php

namespace app\controllers\integration;

use app\models\integration\record\ProcessingMeeting;
use Swagger\Annotations as SWG;
use Yii;

class MeetingsController extends AbstractIntegrationController
{
	/**
	 * @SWG\Post(path = "/meetings",
	 *     tags = {"Meetings"},
	 *     security={
	 *         {"default": {}}
	 *     },
	 *     summary = "Создает собрание.",
	 *     @SWG\Parameter(
	 *     		name="body",
	 *     		in="body",
	 *     		required=true,
	 * 			@SWG\Schema(ref="#/definitions/MeetingRequestCreation")
	 *     ),
	 *     @SWG\Response(
	 *         response = 201,
	 *         description = "Возвращает идентификатор созданного собрания.",
	 *         @SWG\Schema(
	 *     			type="object",
	 *     			properties={
	 *     				@SWG\Property(type="integer", property="id", example="1")
	 *     			}
	 * 		   )
	 *     )
	 * )
	 *
	 */
	public function actionCreate(): array
	{
		$processingMeeting = new ProcessingMeeting(['user_id' => Yii::$app->user->id]);
		$processingMeeting->load(Yii::$app->request->post(), '');
		if ($processingMeeting->validate()) {
			$processingMeeting->save();
		} else {
			return ['errors' => $processingMeeting->errors];
		}

		return ['id' => $processingMeeting->id];
	}

	/**
	 * @SWG\Get(path = "/meetings",
	 *     tags = {"Meetings"},
	 *     security={
	 *         {"default": {}}
	 *     },
	 *     summary = "Получает список собраний.",
	 *     @SWG\Parameter(
	 *     		name="limit",
	 *     		type="integer",
	 *     		in="query",
	 *     		default=10
	 *     ),
	 *     @SWG\Response(
	 *         response = 200,
	 *         description = "Возвращает список собраний.",
	 *         @SWG\Items(ref = "#/definitions/MeetingResponse")
	 *     )
	 * )
	 *
	 */
	public function actionCollection(): array
	{
		$limit = Yii::$app->request->getQueryParam('limit', 10);
		return ProcessingMeeting::find()->limit($limit)->all();
	}

	/**
	 * @SWG\Put(path = "/meetings/{id}",
	 *     tags = {"Meetings"},
	 *     security={
	 *         {"default": {}}
	 *     },
	 *     summary = "Обновляет собрание, делая его обрабатываемым.",
	 *     @SWG\Parameter(
	 *     		name="id",
	 *     		type="integer",
	 *     		in="path"
	 *     ),
	 *     @SWG\Parameter(
	 *     		name="body",
	 *     		in="body",
	 *     		required=true,
	 * 			@SWG\Schema(ref="#/definitions/MeetingRequestUpdate")
	 *     ),
	 *     @SWG\Response(
	 *         response = 204,
	 *         description = "Собрание успешно обновленно.",
	 *         @SWG\Schema(ref = "#/definitions/MeetingResponse")
	 *     )
	 * )
	 *
	 */
	public function actionUpdate(string $id): array
	{
		$processingMeeting = ProcessingMeeting::findOne([$id]);
		if ($processingMeeting === null) {
			throw new \yii\web\NotFoundHttpException();
		}

		$processingMeeting->setScenario(ProcessingMeeting::SCENARIO_UPDATE);
		if ($processingMeeting->load(Yii::$app->request->bodyParams, '') && $processingMeeting->validate()) {
			$processingMeeting->save();
		} else {
			return [
				'errors' => $processingMeeting->errors,
			];
		}

		return $processingMeeting->toArray();
	}
}