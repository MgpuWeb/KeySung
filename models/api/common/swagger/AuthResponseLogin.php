<?php

namespace app\models\api\common\swagger;

use Swagger\Annotations as SWG;
use yii\base\Model;

/**
 * @SWG\Definition(required={"token"})
 *
 * @SWG\Property(
 *     property="token",
 *     example="123e4567-e89b-12d3-a456-426614174000",
 *     type="string",
 *     description="Токен пользователя."
 * )
 */
class AuthResponseLogin extends Model
{
}