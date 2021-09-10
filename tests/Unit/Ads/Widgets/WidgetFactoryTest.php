<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Unit\Ads\Widgets;

use PHPUnit\Framework\TestCase;
use BusinessLogic\Ads\Widgets\WidgetFactory;

/**
 * @uses BusinessLogic\Ads\Widgets\WidgetFactory::__construct
 */
class WidgetFactoryTest extends TestCase
{
    private $widgetFactory;

    public function setUp(): void
    {
        $this->widgetFactory = new WidgetFactory();
    }

    /**
    * @covers BusinessLogic\Ads\Widgets\WidgetFactory::create
    */
    public function testCreateEmbedClass()
    {
        $class = $this->widgetFactory->create('embed');

        $this->assertInstanceOf('BusinessLogic\Ads\Widgets\Embed', $class);
    }

    /**
    * @covers BusinessLogic\Ads\Widgets\WidgetFactory::create
    */
    public function testCreateParagraphClass()
    {
        $class = $this->widgetFactory->create('paragraph');

        $this->assertInstanceOf('BusinessLogic\Ads\Widgets\Paragraph', $class);
    }

    /**
    * @covers BusinessLogic\Ads\Widgets\WidgetFactory::create
    */
    public function testCreateRelatedArticlesClass()
    {
        $class = $this->widgetFactory->create('related_articles');

        $this->assertInstanceOf('BusinessLogic\Ads\Widgets\RelatedArticles', $class);
    }
}
