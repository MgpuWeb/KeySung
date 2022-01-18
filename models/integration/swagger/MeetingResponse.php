<?php

namespace app\models\integration\swagger;

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(required={"id", "processor_id", "type", "url"})
 *
 * @SWG\Property(
 *     property="id",
 *     type="integer",
 *     example=1,
 *     description="Идентификатор собрания."
 * )
 * @SWG\Property(
 *     property="type",
 *     type="string",
 *     enum={"zoom", "teams"},
 *     description="Тип собрания."
 * )
 * @SWG\Property(
 *     property="url",
 *     type="string",
 *     example="https://teams.com/url-to-meeting",
 *     description="Ссылка на собрание."
 * )
 * @SWG\Property(
 *     property="processor_id",
 *     type="string",
 *     example="123e4567-e89b-12d3-a456-426614174000",
 *     description="Идентификатор обработчика."
 * )
 */
class MeetingResponse extends \yii\base\Model
{

}