<?php

declare(strict_types=1);

namespace BusinessLogic\Ads;

trait AdsTrait
{
    public static function get(): array
    {
        return [['layout' => 'ad']];
    }
}
