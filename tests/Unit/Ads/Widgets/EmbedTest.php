<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Unit\Ads\Widgets;

use BusinessLogic\Ads\Widgets\Embed;
use PHPUnit\Framework\TestCase;

/**
 * @uses BusinessLogic\Ads\Widgets\Embed::__construct
 */
class EmbedTest extends TestCase
{
    private $embed;

    public function setUp(): void
    {
        $this->embed = new Embed();
    }

    /**
    * @covers BusinessLogic\Ads\Widgets\Embed::getPointsValue
    * @dataProvider getEmbedWidget
    */
    public function testGetPointsValue(int $expectedResult, array $actualInput): void
    {
        $points = $this->embed->getPointsValue($actualInput);

        $this->assertEquals($points, $expectedResult);
    }

    public function getEmbedWidget(): array
    {
        return [[
            1,
            [
                'layout' => 'embed',
                'link' => 'https://www.google.com/',
            ]
        ]];
    }
}
