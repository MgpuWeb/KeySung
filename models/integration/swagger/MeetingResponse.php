<?php

namespace app\models\integration\swagger;

use Swagger\Annotations as SWG;
use yii\base\Model;

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
 * @SWG\Property(
 *     property="date_start",
 *     type="string",
 *     format="date-time",
 *     example="2022-07-21 17:32:28",
 *     description="Дата начала собрания."
 * )
 * @SWG\Property(
 *     property="date_end",
 *     type="string",
 *     format="date-time",
 *     example="2022-07-21 20:32:28",
 *     description="Дата конца собрания."
 * )
 */
class MeetingResponse extends Model
{

}