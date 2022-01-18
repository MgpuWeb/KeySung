<?php

namespace app\controllers\ajax;

use Swagger\Annotations as SWG;

/**
 * @SWG\Swagger(
 *     basePath="/ajax",
 *     produces={"application/json"},
 *     consumes={"application/x-www-form-urlencoded"},
 *     @SWG\Info(version="1.0", title="AJAX REST API")
 * )
 * @SWG\SecurityScheme(
 *   type="apiKey",
 *   securityDefinition="default",
 *   in="header",
 *   name="Authorization"
 * )
 */
class SwaggerController
{
}