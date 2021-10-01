<?php

namespace app\controllers\ajax;

use Swagger\Annotations as SWG;
/** @todo: Сделать взаимодействие с клиентом для сервиса Влада */
class MeetingsController extends AbstractAjaxController
{
    /**
     * @SWG\Get(path="/meetings",
     *     tags={"User"},
     *     summary="Retrieves the collection of Meeting resources.",
     *     @SWG\Response(
     *         response = 200,
     *         description = "Meeting collection response",
     *         @SWG\Schema(ref = "#/definitions/Meeting")
     *     ),
     * )
     */
    public function actionIndex(): array
    {
        return [];
    }

    public function actionView(string $id): array
    {
        return [];
    }

}