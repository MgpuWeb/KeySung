<?php

namespace app\controllers\integration;

use Swagger\Annotations as SWG;

/**
 * @SWG\Swagger(
 *     basePath="/integration",
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *     @SWG\Info(version="1.0", title="INTEGRATION REST API")
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