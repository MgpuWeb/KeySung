<?php

namespace app\models\integration\swagger;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"type", "url"})
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
 */
class MeetingRequestCreation extends Model
{

}