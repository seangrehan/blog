<?php

$container = require __DIR__ . '/../app/bootstrap.php';

use BusinessLogic\BusinessLogic;

$app = $container->get(BusinessLogic::class);

$response = $app->start(1);

header($response->contentType, response_code: $response->httpCode);
echo $response->article;
