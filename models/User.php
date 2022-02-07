<?php

namespace app\models;

use app\models\enum\user\Status;
use app\services\user\contract\model\UserInterface;
use Kartavik\Yii2\Validators\EnumValidator;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 * @property string $email
 * @property string $password
 * @property string $access_token
 * @property string $remember_me_token
 * @property integer $status
 * @property string $email_confirmation_token
 */
class User extends ActiveRecord implements IdentityInterface, UserInterface
{
    public const SCENARIO_REGISTRATION = 'registration';

	public static function tableName()
	{
		return 'users';
	}

    public function rules()
    {
        return [
            [
                'status',
                EnumValidator::class,
                'targetEnum' => Status::class,
            ],
            [
                'email',
                'unique',
                'message' => 'Почтовый ящик уже используется. Выберите другой.',
                'on' => self::SCENARIO_REGISTRATION
            ],
            ['password', 'string'],
        ];
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

    public function getId(): int
    {
        return $this->id;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function setAccessToken(string $token): void
    {
        $this->access_token = $token;
    }

    public function setRememberMeToken(string $token): void
    {
        $this->remember_me_token = $token;
    }

	public function getAuthKey()
	{
		return $this->remember_me_token;
	}

	public function validateAuthKey($authKey)
	{
		return $this->remember_me_token === $authKey;
	}

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->remember_me_token = \Yii::$app->security->generateRandomString();
                $this->email_confirmation_token = \Yii::$app->security->generateRandomString();
                $this->access_token = \Yii::$app->security->generateRandomString();
            }

            return true;
        }

        return false;
    }
}
