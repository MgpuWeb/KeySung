<?php

namespace app\models\api\common\swagger;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"id", "predominantEmotion", "meta"})
 *
 * @SWG\Property(
 *     property="id",
 *     type="integer",
 *     description="Идентификатор участника собрания."
 * )
 * @SWG\Property(
 *     property="predominantEmotion",
 *     type="string",
 *     enum={"neutral", "happy", "sad", "surprise", "angry"},
 *     description="Преобладающая эмоция.",
 * )
 * @SWG\Property(
 *     property="meta",
 *     ref="#/definitions/MeetingParticipantMeta",
 *     description="Мета информация участника собрания.",
 * )
 */
class MeetingParticipant extends Model
{
	public int $id;
	public string $predominantEmotion;
	public MeetingParticipantMeta $meta;
}