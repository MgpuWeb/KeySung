<?php

namespace app\controllers\api\integration;

use Swagger\Annotations as SWG;

/**
 * @SWG\Swagger(
 *     basePath="/api/integration",
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