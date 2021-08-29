<?php

use function DI\autowire;
use function DI\create;
use function DI\get;
use BusinessLogic\Ads\AdsInjectorInterface;
use BusinessLogic\Ads\AdsInjector;
use BusinessLogic\BusinessLogic;
use BusinessLogic\Repository\RepositoryInterface;
use BusinessLogic\Repository\Repository;
use BusinessLogic\Storage;

return [
    StorageInterface::class => autowire(Storage::class),
    AdsInjectorInterface::class => autowire(AdsInjector::class),
    RepositoryInterface::class => create(Repository::class)
        ->constructor(
            get(Storage::class)
        ),
    BusinessLogic\BusinessLogic::class => create()
        ->constructor(
            autowire(Repository::class),
            autowire(AdsInjector::class),
        ),
];
