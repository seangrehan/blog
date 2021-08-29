<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Unit\Ads\Widgets;

use PHPUnit\Framework\TestCase;
use BusinessLogic\Ads\Widgets\Paragraph;

/**
 * @covers BusinessLogic\Ads\Widgets\Paragraph
 */
class ParagraphTest extends TestCase
{
    private $paragraph;

    public function setUp(): void
    {
        $this->paragraph = new Paragraph();
    }

    public function testGetPointsValue()
    {
        $widget = [
            'layout' => 'paragraph',
            'text' => '<p>When it comes to <a href=\"https:\/\/www.stylist.co.uk\/fitness-health\/weighlifting-for-beginners-women-how-to-start-strength-weight-training-advice-tips\/338355\" target=\"_blank\" rel=\"noopener noreferrer\">strength training<\/a>, there are generally two main arguments: one is that there is no difference between women and men, so they should train the same. The other is that women are fragile and need a completely different approach. Of course, neither are fact, but the first statement is at least closer to the truth.\u00a0<\/p>'
        ];

        $points = $this->paragraph->getPointsValue($widget);

        $this->assertIsFloat($points);
    }
}
