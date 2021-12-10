<?php

namespace app\models\ajax;

use DateTimeInterface;
use JetBrains\PhpStorm\ArrayShape;
use Swagger\Annotations as SWG;
use Yii;
use yii\base\Model;
use yii\behaviors\AttributeBehavior;


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
    public string $id;
    public string $externalId;
    public DateTimeInterface $createdAt;

    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'Идентификатор собрания'),
            'externalId' => Yii::t('app', 'Идентификатор организатора собрания'),
            'createdAt' => Yii::t('app', 'Дата начала собрания'),
        ];
    }

    /**
     * @param array $fields
     * @param array $expand
     * @param bool $recursive
     * @return array|string[]
     * @todo: пока не понял почему аттрибут DateTimeInterface не преобразовывается в string. Если не переопределять формат вывода, то поле createdAt отображается как мустой массив createdAt => []
     */
    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        return array_merge(parent::toArray($fields, $expand, $recursive), [
            'createdAt' => $this->createdAt->format('c')
        ]);
    }
}