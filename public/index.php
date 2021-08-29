<?php

require_once __DIR__ . '/../vendor/autoload.php';

use BusinessLogic\Repository\Repository;
use BusinessLogic\Ads\AdsInjector;
use BusinessLogic\Storage;
use BusinessLogic\Ads\Widgets\WidgetFactory;
use BusinessLogic\BusinessLogic;

$storage = new Storage();
$widgetFactory = new WidgetFactory();

$repository = new Repository($storage);
$adsInjector = new AdsInjector($widgetFactory);

$app = new BusinessLogic($repository, $adsInjector);

$response = $app->start(1);

header($response->contentType, response_code: $response->httpCode);
echo $response->article;
