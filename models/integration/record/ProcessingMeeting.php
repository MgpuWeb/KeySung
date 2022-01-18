<?php

namespace app\models\integration\record;

use app\models\User;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property User $owner
 * @property string $processor_id
 * @property string $type
 * @property string $url
 *
 */
class ProcessingMeeting extends ActiveRecord
{
	public const TYPE_ZOOM  = 'zoom';
	public const TYPE_TEAMS = 'teams';

	public const SCENARIO_UPDATE = 'update';

	public static function tableName()
	{
		return 'processing_meetings';
	}

	public function rules()
	{
		return [
			[['type', 'url'], 'required'],
			['url', 'url'],
			['type', 'in', 'range' => [self::TYPE_TEAMS, self::TYPE_ZOOM]],
		];
	}

	public function scenarios()
	{
		return array_merge(parent::scenarios(), [
			self::SCENARIO_UPDATE => [
				'!type',
				'!url',
				'processor_id'
			],
		]);
	}

	public function getOwner()
	{
		return $this->hasOne(User::class, ['id' => 'user_id']);
	}
}