<?php

namespace app\controllers\ajax;

use Swagger\Annotations as SWG;

class MeetingsController extends AbstractAjaxController
{
	/**
	 * @SWG\Get(path="/meetings",
	 *     tags = {"Meetings"},
	 *     summary = "Возвращает идентификаторы последних собраний.",
	 *     @SWG\Response(
	 *         response = 200,
	 *         description = "Коллекция собраний.",
	 *         @SWG\Schema(
	 *     	       type="array",
	 *     		   @SWG\Items(ref="#/definitions/Meeting"),
	 * 	       ),
	 *     ),
	 * )
	 */
	public function actionIndex(): array
	{
		return [];
	}

	/**
	 * @SWG\Get(path = "/meetings/{id}",
	 *     tags = {"Meetings"},
	 *     summary = "Возвращает полную информацию о собрании по переданному идентификатору.",
	 *     @SWG\Parameter(
	 *         name = "id",
	 *         in = "path",
	 *         description = "Идентификатор собрания.",
	 *         required = true,
	 *		   type="string"
	 *     ),
	 *     @SWG\Response(
	 *         response = 200,
	 *         description = "Коллекция собраний.",
	 *         @SWG\Schema(ref = "#/definitions/Meeting")
	 *     ),
	 *     @SWG\Response(
	 *         response = 404,
	 *         description = "Собрание не найдено."
	 *     ),
	 * )
	 */
	public function actionView(string $id): array
	{
		return [];
	}

}