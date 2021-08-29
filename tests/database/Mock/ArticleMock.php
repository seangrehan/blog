<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Database\Mock;

use BusinessLogic\StorageInterface;

class ArticleMock implements StorageInterface
{
    public function get(string $file): string
    {
        $id = (int) filter_var($file, FILTER_SANITIZE_NUMBER_INT);
        $folder = __DIR__ . '/../../../tests/storage/articles/';

        match ($id) {
            1 => $file = '/healthy.json',
            2 => $file = '/truncated.json',
            3 => $file = '/empty.json',
            4 => $file = '/no_widgets.json',
            default => throw new \Exception('File Not Found', 404),
        };

        return file_get_contents($folder . $file, true);
    }
}
