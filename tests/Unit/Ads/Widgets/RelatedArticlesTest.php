<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Unit\Ads\Widgets;

use BusinessLogic\Ads\Widgets\RelatedArticles;
use PHPUnit\Framework\TestCase;

/**
 * @uses BusinessLogic\Ads\Widgets\RelatedArticles::__construct
 */
class RelatedArticlesTest extends TestCase
{
    private $relatedArticles;

    public function setUp(): void
    {
        $this->relatedArticles = new RelatedArticles();
    }

    /**
    * @covers BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
    */
    public function testGetPointsValue(): void
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
