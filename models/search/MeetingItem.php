<?php

namespace app\models\search;

use Yii;
use yii\data\ArrayDataProvider;

class MeetingItem extends \app\models\ajax\MeetingItem
{
    public function rules()
    {
        return [
            ['externalId', 'string'],
            ['createdAt', 'datetime'],
        ];
    }

    public function search($params): ArrayDataProvider
    {
        /** @var \app\models\ajax\MeetingItem[] $meetings */
        $meetings = Yii::$app->runAction("/ajax/meetings/collection");
        return new ArrayDataProvider([
            'allModels' => $meetings,
            'sort' => [
                'attributes' => [
                    'externalId'
                ],
            ],
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);
    }
}