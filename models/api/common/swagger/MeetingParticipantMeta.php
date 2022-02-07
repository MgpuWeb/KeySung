<?php

namespace app\models\api\common\swagger;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"avatarPath"})
 *
 * @SWG\Property(
 *     property="avatarPath",
 *     type="string",
 *     description="Путь до аватарки пользователя собрания."
 * )
 */
class MeetingParticipantMeta extends Model
{
	public ?string $avatarPath;
}