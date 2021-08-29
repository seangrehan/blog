<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Feature\Ads;

use PHPUnit\Framework\TestCase;
use BusinessLogic\Repository\Repository;
use BusinessLogic\Tests\Database\Mock\ArticleMock;
use BusinessLogic\Ads\AdsInjector;
use BusinessLogic\Ads\Widgets\WidgetFactory;
use BusinessLogic\BusinessLogic;

/**
 * @covers BusinessLogic\BusinessLogic
 */
class BusinessLogicTest extends TestCase
{
    private $BusinessLogic;

    public function setUp(): void
    {
        $storage = new ArticleMock();
        $repository = new Repository($storage);

        $widgetFactory = new WidgetFactory();
        $adsInjector = new AdsInjector($widgetFactory);

        $this->BusinessLogic = new BusinessLogic($repository, $adsInjector);
    }

    /**
     * @uses BusinessLogic\Repository\Repository::__construct
     * @uses BusinessLogic\Ads\AdsInjector::__construct
     * @uses BusinessLogic\Ads\AdsInjector::inject
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testStartExistingArticle(): void
    {
        $article = $this->BusinessLogic->start(1);

        $this->assertIsObject($article);
    }

    /**
     * @uses BusinessLogic\Repository\Repository::__construct
     * @uses BusinessLogic\Ads\AdsInjector::__construct
     * @uses BusinessLogic\Ads\AdsInjector::inject
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testStartMissingArticle(): void
    {
        $article = $this->BusinessLogic->start(5);

        $this->assertIsObject($article);
    }
}
