<?php

namespace app\controllers\ajax;

use app\models\ajax\Meeting;
use app\models\ajax\MeetingParticipant;
use app\services\meeting\contract\MeetingServiceInterface;
use app\services\meeting\contract\models\MeetingInterface;
use app\services\meeting\contract\models\MeetingParticipantInterface;
use app\services\meeting\implementation\rest\response\Session;
use app\services\meeting\implementation\rest\response\SessionPerson;
use Swagger\Annotations as SWG;

class MeetingsController extends AbstractAjaxController
{
	/**
	 * @SWG\Get(path = "/meetings/{id}",
	 *     tags = {"Meetings"},
	 *     summary = "Возвращает полную информацию о собрании по переданному идентификатору.",
	 *     @SWG\Parameter(
	 *         name = "id",
	 *         in = "path",
	 *         description = "Идентификатор собрания.",
	 *         required = true,
	 *           type="string"
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
	 * @return Meeting
	 */
	public function actionView(string $id, MeetingServiceInterface $meetingService): Meeting
	{
//		$meeting = $meetingService->getById($id);
		$meeting = $this->getFakeMeeting($id); // удалить после запуска сервиса Влада

		return new Meeting([
			'id' => $meeting->getId(),
			'participants' => array_map(static function (MeetingParticipantInterface $participant): MeetingParticipant {
				return new MeetingParticipant([
					'id' => $participant->getId(),
					'predominantEmotion' => $participant->getPredominantEmotion(),
				]);
			}, $meeting->getParticipants())
		]);
	}

	private function getFakeMeeting(string $id): MeetingInterface
	{
		return new Session($id, [
			new SessionPerson(1, ["neutral", "happy", "sad", "surprise", "angry"][random_int(0, 4)]),
			new SessionPerson(2, ["neutral", "happy", "sad", "surprise", "angry"][random_int(0, 4)]),
			new SessionPerson(3, ["neutral", "happy", "sad", "surprise", "angry"][random_int(0, 4)]),
			new SessionPerson(4, ["neutral", "happy", "sad", "surprise", "angry"][random_int(0, 4)]),
			new SessionPerson(5, ["neutral", "happy", "sad", "surprise", "angry"][random_int(0, 4)]),
			new SessionPerson(6, ["neutral", "happy", "sad", "surprise", "angry"][random_int(0, 4)]),
		]);
	}

}