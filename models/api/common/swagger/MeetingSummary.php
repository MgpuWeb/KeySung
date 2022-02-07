<?php

namespace app\models\api\common\swagger;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"id", "participants"})
 *
 * @SWG\Property(
 *     property="id",
 *     type="string",
 *     description="Идентификатор собрания."
 * )
 * @SWG\Property(
 *     property="participants",
 *     type="array",
 *     @SWG\Items(ref="#/definitions/MeetingSummaryParticipant"),
 *     description="Коллекция участников собрания."
 * )
 */
class MeetingSummary extends Model
{
    public string $id;

    /**
     * @var MeetingSummaryParticipant[]
     */
    public array $participants;
}