<?php

namespace app\models\search;

use Yii;
use yii\data\ArrayDataProvider;

class MeetingItem extends \app\models\ajax\MeetingItem
{
    public ?string $id = null;
    public ?string $externalId = null;
    public ?string $createdAt = null;

    public function rules()
    {
        return array_merge(parent::rules(), [

        ]);
    }

    public function search(array $parameters): ArrayDataProvider
    {
        var_dump($parameters);exit;
        $dataProvider = new ArrayDataProvider([
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        $dataProvider->allModels = Yii::$app->runAction("/ajax/meetings/collection");
        if (!$this->load($parameters) || !$this->validate()) {
            return $dataProvider;
        } else {
            Yii::$app->request->setQueryParams([
                'externalId' => $this->externalId,
            ]);
        }

        return $dataProvider;
    }
}