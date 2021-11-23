<?php

namespace app\services\meeting\implementation\rest;

use app\services\meeting\contract;
use app\services\meeting\contract\models;

final class Service implements contract\MeetingServiceInterface
{
    public function __construct(private Facade $facade)
    {
    }

    public function getById(string $id): ?contract\models\MeetingInterface
    {
		return $this->facade->getById($id);
    }

	/**
	 * @param string $id
	 * @return models\MeetingInterface|null
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 * @throws \JsonException
	 * @todo: Это полная залупа в отношениях между объектами, это надо срочно переделать, как будет минутка
	 *
	 * Сейчас сервер предоставляет путь вида /sessions/{id}/meta
	 * Значит meta это отношение сущности sessions, тогда структура ответа
	 * должна быть не в виде меты информации пользователей, а в мете информации сессии
	 *
	 * {
	 *	"id": "lecture_1",
	 *  "meta": {
	 *		"persons": [
	 * 			{
	 *				"id": "1",
	 * 				"avatar_path": "people_images/13g4145d3e.jng"
	 * 			},
	 * 		]
	 * 	 }
	 * }
	 *
	 * Но тогда это будет означать, что в ключе meta будет передаваться вся мета информация под-сущностей данного агрегата
	 * я не думаю, что этот механизм будет гибким при масштабировании данных,
	 * то есть я не смогу запросить мета информацию только по интересующим меня полям
	 *
	 * -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
	 *
	 * Лучше было бы ограничиться методом запроса мета информации у конкретного пользователя
	 * [GET] /sessions/{id}/persons/{id}/meta
	 * Тогда текущий объект person получит модификацию в виде одного релейшена
	 * {
	 *		"id": 1,
	 *      "main_emotion": "angry"
	 * 		"meta": {
	 *			"avatar_path": "people_images/13g4145d3e.jng"
	 * 		}
	 * }
	 *
	 * Попытка агрегации данных снизу, наверное, не совсем лаконичное решение,
	 * но единственное исходя из текущей реализации апи сервиса эмоций.
	 * @see Service::getByIdWithMeta()
	 * Пока я не могу понять к каким проблемам может привести это в будущем, но думаю,
	 * что когда время придёт, то можно будет переделать отношения более корректно
	 *
	 * -+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+
	 *
	 * Идеальным для текущей реализации апи сервиса эмоций будет следующий вариант
	 * [GET] /sessions/{id}?fields[]=persons.meta
	 * [param:fields] array[string]; example: ['persons.meta']
	 * {
	 * 		"id": "lecture_1",
	 * 		"persons": [
	 * 			"id": 1,
	 * 			"main_emotion": "angry",
	 * 			"meta": {
	 *				"avatar_path": "people_images/13g4145d3e.jng"
	 * 			}
	 * 		]
	 * }
	 *
	 * Тогда в будущем такой вид обмена параметрами будет концептуально правилен
	 * и будет возможность масштабирования данного механизма во что-то на подобие нормализации данных на сервере эмоций.
	 * Также это уменьшит кол-во запросов со стороны клиентов (меня)
	 */
	public function getByIdWithMeta(string $id): ?models\MeetingInterface
	{
		$meeting = $this->facade->getById($id);
		if ($meeting === null) {
			return null;
		}

		$meetingMeta = $this->facade->getMetaById($id);
		foreach ($meeting->getParticipants() as $participant) {
			foreach ($meetingMeta->getParticipants() as $participantMeta) {
				if ($participantMeta->getId() === $participant->getId()) {
					$participant->setAvatarPath($participantMeta->getAvatarPath());
				}
			}
		}

		return $meeting;
	}

    public function getSummary(string $id): ?models\MeetingSummaryInterface
    {
        return $this->facade->getSummary($id);
    }
}