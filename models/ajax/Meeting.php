<?php

namespace app\models\ajax;

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
 *     type="array",
 *     @SWG\Items(ref="#/definitions/MeetingParticipant"),
 *     description="Коллекция участников собрания."
 * )
 */
class Meeting extends Model
{
	public string $id;

	/**
	 * @var MeetingParticipant[]
	 */
	public array $participants;
}