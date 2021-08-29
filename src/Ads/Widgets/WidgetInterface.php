<?php

declare(strict_types=1);

namespace BusinessLogic\Ads\Widgets;

interface WidgetInterface
{
    public function getPointsValue(array $widget): float;
}
