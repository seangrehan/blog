<?php

declare(strict_types=1);

namespace BusinessLogic\Ads;

use BusinessLogic\Ads\Widgets\WidgetFactory;

class AdsInjector implements AdsInjectorInterface
{
    public $totalPoints = 0;

    public function __construct(
        private WidgetFactory $widgetFactory
    ) {
    }

    public function inject(array $article, array $advert, float $pointsResetCounter): array
    {
        if (!isset($article['widgets'])) {
            return $article;
        }

        $pointsCounter = 0;
        $classes = [];
        $formattedWidgets = [];

        foreach ($article['widgets'] as $widget) {
            // Prevent recreating already instanced class
            $layout = $widget['layout'];

            $class = $classes[$layout] ??
                $classes[$layout] = $this->widgetFactory->create($widget['layout']);

            $points = $class->getPointsValue($widget);

            $pointsCounter += $points;

            $formattedWidgets[] = $widget;

            if ($pointsCounter >= $pointsResetCounter) {
                $this->totalPoints += $pointsResetCounter;

                // Reset points counter
                $pointsCounter = 0;
                $formattedWidgets[] = $advert;
            }
        }

        $article['widgets'] = $formattedWidgets;

        return $article;
    }
}
