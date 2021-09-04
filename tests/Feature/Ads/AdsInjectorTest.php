<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Feature\Ads;

use PHPUnit\Framework\TestCase;
use BusinessLogic\Repository\Repository;
use BusinessLogic\Tests\Database\Mock\ArticleMock;
use BusinessLogic\Ads\AdsInjector;
use BusinessLogic\Ads\Widgets\WidgetFactory;

/**
 * @covers BusinessLogic\Ads\AdsInjector
 * @uses BusinessLogic\Repository\Repository
 * @uses BusinessLogic\Tests\Database\Mock\ArticleMock
 * @uses BusinessLogic\Ads\Widgets\WidgetFactory
 */
class AdsInjectorTest extends TestCase
{
    private $adsInjector;

    public function setUp(): void
    {
        $storage = new ArticleMock();
        $this->repository = new Repository($storage);

        $widgetFactory = new WidgetFactory();
        $this->adsInjector = new AdsInjector($widgetFactory);
    }

    /**
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testInject(): void
    {
        $article = $this->repository->getArticle(1);
        $advert = [['layout' => 'ad']];
        $points = 3.5;

        $article = $this->adsInjector->inject($article, $advert, $points);

        $this->assertIsArray($article);
    }

    /**
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testInjectArticleNoDuplicateKeys(): void
    {
        $article = $this->repository->getArticle(1);
        $advert = [['layout' => 'ad']];
        $points = 3.5;

        $article = $this->adsInjector->inject($article, $advert, $points);

        foreach ($article['widgets'] as $key => $widget) {
            if ($key !== 0) {
                $this->assertNotEquals($article['widgets'][$key - 1], $widget);
            }
        }
    }

    /**
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testInjectArticleWidgetsAllHaveLayoutKey(): void
    {
        $article = $this->repository->getArticle(1);
        $advert = [['layout' => 'ad']];
        $points = 3.5;

        $article = $this->adsInjector->inject($article, $advert, $points);

        foreach ($article['widgets'] as $widget) {
            $this->assertArrayHasKey('layout', $widget);
        }
    }

    /**
     * @uses BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Ads\Widgets\WidgetFactory::create
     * @uses BusinessLogic\Ads\Widgets\Embed::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
     * @uses BusinessLogic\Ads\Widgets\RelatedArticles::getPointsValue
     */
    public function testInjectNoWidgets(): void
    {
        $article = $this->repository->getArticle(4);
        $advert = [['layout' => 'ad']];
        $points = 3.5;

        $article = $this->adsInjector->inject($article, $advert, $points);

        $this->assertIsArray($article);
    }
}
