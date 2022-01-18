<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 * @property string $email
 * @property string $password
 * @property string $access_token
 */
class User extends ActiveRecord implements IdentityInterface
{
	public static function tableName()
	{
		return 'users';
	}

	/**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
		return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
		return static::findOne(['access_token' => $token]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

	public function getAuthKey()
	{
		// TODO: Implement getAuthKey() method.
	}

	public function validateAuthKey($authKey)
	{
		// TODO: Implement validateAuthKey() method.
	}
}
