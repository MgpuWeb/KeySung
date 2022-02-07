<?php

namespace app\models\search;

use app\models\User;
use Yii;
use yii\data\ArrayDataProvider;

class MeetingItem extends \app\models\api\common\swagger\MeetingItem
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
        $dataProvider = new ArrayDataProvider([
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        /** @var User $user */
        $user = Yii::$app->user->identity;
        Yii::$app->request->headers->set('Authorization', "Bearer {$user->getAccessToken()}");

        $dataProvider->allModels = Yii::$app->runAction("/api/common/meetings/collection");
        if (!$this->load($parameters) || !$this->validate()) {
            return $dataProvider;
        }

        Yii::$app->request->setQueryParams([
            'externalId' => $this->externalId,
        ]);

        return $dataProvider;
    }
}