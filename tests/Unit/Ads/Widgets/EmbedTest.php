<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Unit\Ads\Widgets;

use PHPUnit\Framework\TestCase;
use BusinessLogic\Ads\Widgets\Embed;

/**
 * @covers BusinessLogic\Ads\Widgets\Embed
 */
class EmbedTest extends TestCase
{
    private $embed;

    public function setUp(): void
    {
        $this->embed = new Embed();
    }

    public function testGetPointsValue()
    {
        $widget = ['layout' => 'embed', 'link' => 'https://www.google.com/'];

        $points = $this->embed->getPointsValue($widget);

        $this->assertIsFloat($points);
    }
}
