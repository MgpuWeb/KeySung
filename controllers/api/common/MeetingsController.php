<?php

namespace app\controllers\api\common;

use app\models\api\common\swagger\Emotions;
use app\models\api\common\swagger\Meeting;
use app\models\api\common\swagger\MeetingItem;
use app\models\api\common\swagger\MeetingParticipant;
use app\models\api\common\swagger\MeetingParticipantMeta;
use app\models\api\common\swagger\MeetingSummary;
use app\models\api\common\swagger\MeetingSummaryParticipant;
use app\services\meeting\contract;
use app\controllers\api\AbstractApiController;
use app\services\meeting\contract\MeetingServiceInterface;
use app\services\meeting\contract\models\MeetingParticipantInterface;
use Swagger\Annotations as SWG;
use Yii;

class MeetingsController extends AbstractApiController
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
     * @param contract\MeetingServiceInterface $meetingService
     * @return ?Meeting
     */
    public function actionView(string $id, contract\MeetingServiceInterface $meetingService): ?Meeting
    {
        $meeting = Yii::$app->request->get('meta', true)
            ? $meetingService->getByIdWithMeta($id) : $meetingService->getById($id);

        return $meeting !== null ? new Meeting([
            'id' => $meeting->getId(),
            'participants' => array_map(static function (contract\models\MeetingParticipantInterface $participant): MeetingParticipant {
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

    /**
     * @SWG\Get(path = "/meetings/{id}/summary",
     *     tags = {"Meetings"},
     *     summary = "Возвращает статистику о собрании по переданному идентификатору.",
     *     @SWG\Parameter(
     *         name = "id",
     *         in = "path",
     *         description = "Идентификатор собрания.",
     *         required = true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Коллекция собраний.",
     *         @SWG\Schema(ref = "#/definitions/MeetingSummary")
     *     ),
     *     @SWG\Response(
     *         response = 404,
     *         description = "Собрание не найдено."
     *     ),
     * )
     *
     * @param string $id
     * @param contract\MeetingServiceInterface $meetingService
     * @param contract\filter\Factory $filterFactory
     * @return ?MeetingSummary
     */
    public function actionSummary(string $id, contract\MeetingServiceInterface $meetingService): ?MeetingSummary
    {
        $meetingSummary = $meetingService->getSummary($id);
        return $meetingSummary !== null ? new MeetingSummary([
            'id' => $meetingSummary->getId(),
            'participants' => array_map(static function (contract\models\MeetingParticipantSummaryInterface $participant): MeetingSummaryParticipant {
                return new MeetingSummaryParticipant([
                    'id' => $participant->getId(),
                    'involvement' => $participant->getInvolvement(),
                    'emotions' => new Emotions([
                        'angry' => $participant->getEmotions()->getAngry(),
                        'happy' => $participant->getEmotions()->getHappy(),
                        'neutral' => $participant->getEmotions()->getNeutral(),
                        'sad' => $participant->getEmotions()->getSad(),
                        'surprise' => $participant->getEmotions()->getSurprise(),
                    ])
                ]);
            }, $meetingSummary->getParticipants()),
        ]) : null;
    }

    /**
     * @SWG\Get(path = "/meetings",
     *     tags = {"Meetings"},
     *     summary = "Возвращает неполную информацию о собраниях.",
     *     @SWG\Parameter(
     *         name = "offset",
     *         in = "query",
     *         description = "Количество элементов, которые нужно пропустить перед началом сбора актуальных результатов",
     *         required = false,
     *         default="0",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name = "limit",
     *         in = "query",
     *         description = "Максимальное количество элементов, которые нужно отдать в ответе",
     *         required = false,
     *         default="15",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name = "externalId",
     *         in = "query",
     *         description = "Искать по идентификатору организатора",
     *         required = false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name = "order[createdAt]",
     *         in = "query",
     *         description = "Сортировать по дате создаиня собрания",
     *         required = false,
     *         type="string",
     *         enum={"desc", "asc"}
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Коллекция собраний.",
     *         @SWG\Schema(ref = "#/definitions/MeetingItem")
     *     ),
     * )
     *
     * @param contract\MeetingServiceInterface $meetingService
     * @param contract\filter\Factory $filterFactory
     * @return MeetingItem[]
     */
    public function actionCollection(contract\MeetingServiceInterface $meetingService, contract\filter\Factory $filterFactory): array
    {
        $filters = [
            $filterFactory->value('offset', Yii::$app->request->getQueryParam('offset', 0)),
            $filterFactory->value('limit', Yii::$app->request->getQueryParam('limit', 20)),
        ];

        $externalIdFilter = Yii::$app->request->getQueryParam('externalId');
        if ($externalIdFilter !== null) {
            $filters[] = $filterFactory->value('externalId', $externalIdFilter);
        }

        foreach (Yii::$app->request->getQueryParam('order', []) as $orderAttribute => $orderType) {
            $filters[] = $filterFactory->order($orderAttribute, $orderType);
        }

        $meetingItems = $meetingService->getCollection($filters);
        return !empty($meetingItems) ? array_map(static function (contract\models\MeetingItemInterface $item): MeetingItem {
            return new MeetingItem([
                'id'         => $item->getId(),
                'externalId' => $item->getExternalId(),
                'createdAt'  => $item->getCreatedAt()->format('c'),
            ]);
        }, $meetingItems) : [];
    }
}