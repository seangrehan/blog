<?php

declare(strict_types=1);

namespace BusinessLogic\Ads;

use BusinessLogic\Ads\Widgets\WidgetFactory;

class AdsInjector implements AdsInjectorInterface
{
    public function __construct(
        private WidgetFactory $widgetFactory
    ) {
    }

    public function inject(array $article, array $advert, float $points): array
    {
        if (!isset($article['widgets'])) {
            return $article;
        }

        $pointsValue = $adsCounter = 0;
        $classes = [];

        foreach ($article['widgets'] as $widget) {
            // Prevent recreating already instanced class
            $layout = $widget['layout'];

            $class = isset($classes[$layout])
                ? $classes[$layout]
                : $classes[$layout] = $this->widgetFactory->create($widget['layout']);

            $class = $classes[$widget['layout']];

            $pointsValue += $class->getPointsValue($widget);

            // Use counter instead of array key incase key is not int
            ++$adsCounter;

            if ($points >= $pointsValue) {
                // Reset points counter
                $points = 0;

                // If points are equal or more than 3.5 then add an ad before the next widget
                array_splice($article['widgets'], $adsCounter, 0, $advert);
            }
        }

        return $article;
    }
}
