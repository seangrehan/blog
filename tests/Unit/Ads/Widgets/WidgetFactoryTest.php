<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Unit\Ads\Widgets;

use PHPUnit\Framework\TestCase;
use BusinessLogic\Ads\Widgets\WidgetFactory;

/**
 * @covers BusinessLogic\Ads\Widgets\WidgetFactory
 */
class WidgetFactoryTest extends TestCase
{
    private $widgetFactory;

    public function setUp(): void
    {
        $this->widgetFactory = new WidgetFactory();
    }

    public function testCreateEmbedClass()
    {
        $class = $this->widgetFactory->create('embed');

        $this->assertInstanceOf('BusinessLogic\Ads\Widgets\Embed', $class);
    }
}
