<?php

namespace app\models\ajax;

use Swagger\Annotations as SWG;
use Yii;
use yii\base\Model;


/**
 * @SWG\Definition(required={"id", "externalId", "createdAt"})
 *
 * @SWG\Property(
 *     property="id",
 *     type="string",
 *     description="Идентификатор собрания."
 * )
 * @SWG\Property(
 *     property="externalId",
 *     type="string",
 *     description="Идентификатор организатора собрания."
 * )
 * @SWG\Property(
 *     property="createdAt",
 *     type="string",
 *     format="date-time",
 *     description="Дата создания собрания."
 * )
 */
class MeetingItem extends Model
{
    public ?string $id;
    public ?string $externalId;
    public ?string $createdAt;

    public function rules()
    {
        return [
            ['externalId', 'string'],
            ['createdAt', 'datetime'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'Идентификатор'),
            'externalId' => Yii::t('app', 'Идентификатор организатора'),
            'createdAt' => Yii::t('app', 'Дата начала'),
        ];
    }
}