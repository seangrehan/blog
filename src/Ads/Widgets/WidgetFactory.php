<?php

declare(strict_types=1);

namespace BusinessLogic\Ads\Widgets;

use BusinessLogic\Ads\Widgets\WidgetInterface;

class WidgetFactory
{
    public function create(string $className): WidgetInterface
    {
        $class = '';

        foreach (explode('_', $className) as $fragment) {
            $class .= ucfirst($fragment);
        }

        $class = 'BusinessLogic\\Ads\\Widgets\\' . $class;

        return new $class();
    }
}
