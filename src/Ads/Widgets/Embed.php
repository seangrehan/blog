<?php

declare(strict_types=1);

namespace BusinessLogic\Ads\Widgets;

class Embed implements WidgetInterface
{
    public function getPointsValue(array $widget): float
    {
        return 1;
    }
}
