<?php

declare(strict_types=1);

namespace BusinessLogic\Ads;

interface AdsInjectorInterface
{
    public function inject(array $article, array $advert, float $points): array;
}
