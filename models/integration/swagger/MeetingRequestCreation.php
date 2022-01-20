<?php

namespace app\models\integration\swagger;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"type", "url", "start_date", "end_date"})
 *
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
class MeetingRequestCreation extends Model
{

}