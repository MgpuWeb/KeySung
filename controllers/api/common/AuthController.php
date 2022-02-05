<?php

namespace app\controllers\api\common;

use app\controllers\api\AbstractApiController;
use app\models\api\common\swagger;
use app\services\user\contract\UserServiceInterface;
use Swagger\Annotations as SWG;

class AuthController extends AbstractApiController
{
    public function behaviors()
    {
        return [];
    }

    /**
     * @SWG\Post(path = "/auth/login",
     *     tags = {"Auth"},
     *     security={
     *         {"default": {}}
     *     },
     *     summary = "Позволяет авторизоваться по логину и паролю",
     *     @SWG\Parameter(
     *     		name="body",
     *     		in="body",
     *     		required=true,
     * 			@SWG\Schema(ref="#/definitions/AuthRequestLogin")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Успешно авторизован.",
     *         @SWG\Schema(ref = "#/definitions/AuthResponseLogin")
     *     )
     * )
     *
     */
    public function actionLogin(UserServiceInterface $userService): array
    {
        $request = new swagger\AuthRequestLogin();
        if (!$request->load(\Yii::$app->request->getBodyParams(), '') || !$request->validate()) {
            return [
                'errors' => $request->getErrorSummary(true)
            ];
        }

        $user = $userService->authenticate($request->email, $request->password);
        return ['token' => $user->getAccessToken()];
    }
}