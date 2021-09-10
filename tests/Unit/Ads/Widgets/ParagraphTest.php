<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Unit\Ads\Widgets;

use BusinessLogic\Ads\Widgets\Paragraph;
use PHPUnit\Framework\TestCase;

/**
 * @uses BusinessLogic\Ads\Widgets\Paragraph::__contruct
 */
class ParagraphTest extends TestCase
{
    private $paragraph;

    public function setUp(): void
    {
        $this->paragraph = new Paragraph();
    }

    /**
    * @covers BusinessLogic\Ads\Widgets\Paragraph::getPointsValue
    * @dataProvider getParagraphWidget
    */
    public function testGetPointsValue(int $expectedResult, array $actualInput)
    {
        $points = $this->paragraph->getPointsValue($actualInput);

        $this->assertEquals($points, $expectedResult);
    }

    public function getParagraphWidget(): array
    {
        return [[
            1,
            [
                'layout' => 'paragraph',
                'text' => '<p>Secondly, put onto a clean work surface dusted with some extra flour and knead by pushing and rolling the dough with your palm about 5 minutes. Then transfer back into your mixing should be very lightly oiled to prevent sticking and cover with a clean and slightly damp tea-towel for 2 to 3 hours, or until doubled in size at room temperture.<\/p><p>Finally, preheat your oven to 210 \u2103 and put your dutch oven inside. Then take your dough from your mixing bowl and put back on your lightly dusted clean work surface and fold each corner into the middle and flip over to keep the shape intact; should look like a cylinder. Leave your loaf under your tea towel until the oven has completely heated up. Carefully remove the dutch oven from the oven and put on a safe place on your work surface. Take the lid off and dust the bottom with some flour to prevent sticking, carefully tranfer your loaf into the Dutch Oven and spray with clean water, then put the lid back on and out into the oven for 25 minutes<\/p>',
            ]
        ]];
    }
}
