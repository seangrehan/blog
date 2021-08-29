<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Unit\Ads\Widgets;

use PHPUnit\Framework\TestCase;
use BusinessLogic\Ads\Widgets\RelatedArticles;

/**
 * @covers BusinessLogic\Ads\Widgets\RelatedArticles
 */
class RelatedArticlesTest extends TestCase
{
    private $relatedArticles;

    public function setUp(): void
    {
        $this->relatedArticles = new RelatedArticles();
    }

    public function testGetPointsValue()
    {
        $widget = [
            'layout' => 'related_articles',
            'text' => 'You may also like',
            'article' => 3
        ];

        $points = $this->relatedArticles->getPointsValue($widget);

        $this->assertIsFloat($points);
    }
}
