<?php

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(required={"id", "main_emotion"})
 *
 * @SWG\Property(
 *     property="id",
 *     type="string",
 *     description="Идентификатор участника собрания."
 * )
 * @SWG\Property(
 *     property="predominant_emotion",
 *     type="string",
 *     enum={"neutral", "happy", "sad", "surprise", "angry"},
 *     description="Преобладающая эмоция.",
 * )
 */
class MeetingParticipant
{

}