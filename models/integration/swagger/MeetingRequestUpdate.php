<?php

namespace app\models\integration\swagger;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"processor_id"})
 *
 * @SWG\Property(
 *     property="processor_id",
 *     type="string",
 *     example="123e4567-e89b-12d3-a456-426614174000",
 *     description="Идентификатор обработчика."
 * )
 */
class MeetingRequestUpdate extends Model
{

}