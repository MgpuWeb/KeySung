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
 * @property \DateTime $date_start
 * @property \DateTime $date_end
 *
 */
class ProcessingMeeting extends ActiveRecord
{
	public const TYPE_ZOOM  = 'zoom';
	public const TYPE_TEAMS = 'teams';

	public const SCENARIO_UPDATE   = 'update';
	public const SCENARIO_CREATION = 'creation';

	public static function tableName()
	{
		return 'processing_meetings';
	}

	public function rules()
	{
		return [
			[['type', 'url', 'date_start', 'date_end'], 'required'],
			['url', 'url'],
			[['date_start', 'date_end'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
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
            self::SCENARIO_CREATION => [
                'type',
                'url',
                'date_start',
                'date_end',
                '!processor_id',
                '!user_id',
            ],
		]);
	}

	public function getOwner()
	{
		return $this->hasOne(User::class, ['id' => 'user_id']);
	}
}