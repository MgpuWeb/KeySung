<?php

namespace app\models\ajax;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"id", "main_emotion"})
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
 */
class MeetingParticipant extends Model
{
	public int $id;
	public string $predominantEmotion;
}