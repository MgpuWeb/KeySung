<?php

namespace app\models\form;

use yii\base\Model;

class SignUp extends Model
{
    public ?string $email = null;
    public ?string $password = null;

    public function rules()
    {
        return [
            ['email', 'email'],
            ['password', 'string'],
        ];
    }
}