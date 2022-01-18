<?php

namespace app\controllers\ajax;

use app\models\ajax\Meeting;
use app\models\ajax\MeetingParticipant;
use app\models\ajax\MeetingParticipantMeta;
use app\services\meeting\contract\MeetingServiceInterface;
use app\services\meeting\contract\models\MeetingParticipantInterface;
use Swagger\Annotations as SWG;
use Yii;

class MeetingsController extends AbstractAjaxController
{
	/**
	 * @SWG\Get(path = "/meetings/{id}",
	 *     tags = {"Meetings"},
	 *     security={
	 *         {"default": {}}
	 *     },
	 *     summary = "Возвращает полную информацию о собрании по переданному идентификатору.",
	 *     @SWG\Parameter(
	 *         name = "id",
	 *         in = "path",
	 *         description = "Идентификатор собрания.",
	 *         required = true,
	 *           type="string"
	 *     ),
	 *     @SWG\Parameter(
	 *         name = "meta",
	 *         in = "query",
	 *         description = "Нужно ли получить мета данные пользователя собрания.",
	 *         required = false,
	 *         default="true",
	 *         type="boolean"
	 *     ),
	 *     @SWG\Response(
	 *         response = 200,
	 *         description = "Коллекция собраний.",
	 *         @SWG\Schema(ref = "#/definitions/Meeting")
	 *     ),
	 *     @SWG\Response(
	 *         response = 404,
	 *         description = "Собрание не найдено."
	 *     ),
	 * )
	 *
	 * @param string $id
	 * @param MeetingServiceInterface $meetingService
	 * @return ?Meeting
	 */
	public function actionView(string $id, MeetingServiceInterface $meetingService): ?Meeting
	{
		$meeting = Yii::$app->request->get('meta', true)
			? $meetingService->getByIdWithMeta($id) : $meetingService->getById($id);

		return $meeting !== null ? new Meeting([
			'id' => $meeting->getId(),
			'participants' => array_map(static function (MeetingParticipantInterface $participant): MeetingParticipant {
				return new MeetingParticipant([
					'id' => $participant->getId(),
					'predominantEmotion' => $participant->getPredominantEmotion(),
					'meta' => new MeetingParticipantMeta([
						'avatarPath' => $participant->getAvatarPath()
					]),
				]);
			}, $meeting->getParticipants())
		]) : null;
	}
}