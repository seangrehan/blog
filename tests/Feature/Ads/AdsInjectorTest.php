<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Feature\Ads;

use BusinessLogic\Ads\AdsInjector;
use BusinessLogic\Ads\AdsTrait;
use BusinessLogic\Ads\Widgets\PointsTrait;
use BusinessLogic\Ads\Widgets\WidgetFactory;
use BusinessLogic\Repository\Repository;
use BusinessLogic\Tests\Database\Mock\ArticleMock;
use PHPUnit\Framework\TestCase;

/**
 * @uses BusinessLogic\Repository\Repository::__construct
 * @uses BusinessLogic\Tests\Database\Mock\ArticleMock::__construct
 * @uses BusinessLogic\Ads\Widgets\WidgetFactory::__contruct
 * @uses BusinessLogic\Ads\AdsInjector::__contruct
 * @uses BusinessLogic\Ads\AdsTrait::get
 * @uses BusinessLogic\Ads\Widgets\PointsTrait::get
 */
class AdsInjectorTest extends TestCase
{
    private $repository;
    private $adsInjector;
    private $advert;
    private $points;

    public function setUp(): void
    {
        $storage = new ArticleMock();
        $this->repository = new Repository($storage);

        $widgetFactory = new WidgetFactory();
        $this->adsInjector = new AdsInjector($widgetFactory);

        $this->advert = AdsTrait::get();
        $this->points = PointsTrait::get();
    }

    /**
     * @covers BusinessLogic\Ads\AdsInjector::inject
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testInject(): void
    {
        $article = $this->repository->getArticle(1);
        $advert = $this->advert;
        $points = $this->points;

        $article = $this->adsInjector->inject($article, $advert, $points);

        $this->assertIsArray($article);
    }

    /**
     * @covers BusinessLogic\Ads\AdsInjector::inject
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testInjectArticleNoDuplicateKeys(): void
    {
        $article = $this->repository->getArticle(1);
        $advert = $this->advert;
        $points = $this->points;

        $article = $this->adsInjector->inject($article, $advert, $points);

        foreach ($article['widgets'] as $key => $widget) {
            if ($key !== 0) {
                $this->assertNotEquals($article['widgets'][$key - 1], $widget);
            }
        }
    }

    /**
     * @covers BusinessLogic\Ads\AdsInjector::inject
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testInjectArticleHasCorrectNumberOfAds(): void
    {
        $article = $this->repository->getArticle(1);
        $advert = $this->advert;
        $points = 2;

        $article = $this->adsInjector->inject($article, $advert, $points);

        $totalPoints = $this->adsInjector->totalPoints;
        $numberOfExpectedAds = floor($totalPoints / $points);

        $adsCount = 0;
        foreach ($article['widgets'] as $widget) {
            if ($widget['layout'] === 'ad') {
                ++$adsCount;
            }
        }

        $this->assertEquals($numberOfExpectedAds, $adsCount);
    }

    /**
     * @covers BusinessLogic\Ads\AdsInjector::inject
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testInjectArticleWidgetsAllHaveLayoutKey(): void
    {
        $article = $this->repository->getArticle(1);
        $advert = $this->advert;
        $points = $this->points;

        $article = $this->adsInjector->inject($article, $advert, $points);

        foreach ($article['widgets'] as $widget) {
            $this->assertArrayHasKey('layout', $widget);
        }
    }

    /**
     * @covers BusinessLogic\Ads\AdsInjector::inject
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testInjectNoWidgets(): void
    {
        $article = $this->repository->getArticle(4);
        $advert = $this->advert;
        $points = $this->points;

        $article = $this->adsInjector->inject($article, $advert, $points);

        $this->assertIsArray($article);
    }
}
