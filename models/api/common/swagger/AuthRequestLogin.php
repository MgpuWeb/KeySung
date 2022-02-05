<?php

namespace app\models\api\common\swagger;

use app\models\User;
use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(required={"email", "password"})
 *
 * @SWG\Property(
 *     property="email",
 *     example="some-client@email.com",
 *     type="string",
 *     description="Email пользователя."
 * )
 * @SWG\Property(
 *     property="password",
 *     type="string",
 *     example="superSecretPassword",
 *     description="Пароль пользователя."
 * )
 * @property string $email
 * @property string $password
 */
class AuthRequestLogin extends User
{
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'string'],
            [
                ['email'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['email' => 'email'],
                'message' => 'Почтовый ящик не найден.',
            ],

        ];
    }
}