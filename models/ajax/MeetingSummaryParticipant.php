<?php

namespace app\models\ajax;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"id", "emotions"})
 *
 * @SWG\Property(
 *     property="id",
 *     type="integer",
 *     description="Идентификатор участника собрания."
 * )
 * @SWG\Property(
 *     property="emotions",
 *     ref="#/definitions/Emotions",
 *     description="Процентное соотношение эмоций участников собрания.",
 * )
 */
class MeetingSummaryParticipant extends Model
{
    public int $id;
    public float $involvement;
    public Emotions $emotions;
}