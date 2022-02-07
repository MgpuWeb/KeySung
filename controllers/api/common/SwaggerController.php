<?php

namespace app\controllers\api\common;

use Swagger\Annotations as SWG;

/**
 * @SWG\Swagger(
 *     basePath="/api",
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *     @SWG\Info(version="1.0", title="REST API")
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