<?php

namespace app\models\form;

use app\models\User;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class Login extends Model
{
    public ?string $email = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    private ?User $user = null;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            [
                ['email'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['email' => 'email'],
                'message' => 'Почтовый ящик не найден.',
            ]
        ];
    }

    public function validatePassword($attribute, $params)
    {

        if (!$this->hasErrors()) {
            if (!Yii::$app->getSecurity()->validatePassword($this->password, $this->getUser()->password)) {
                $this->addError($attribute, 'Неправильный пароль.');
            }
        }
    }

    public function login()
    {
        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
    }

    public function getUser(): ?User
    {
        if ($this->user === null) {
            $this->user = User::findOne(['email' => $this->email]);
        }

        return $this->user;
    }
}
