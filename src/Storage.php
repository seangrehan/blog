<?php

declare(strict_types=1);

namespace BusinessLogic;

use BusinessLogic\StorageInterface;

class Storage implements StorageInterface
{
    public function get(string $file): string
    {
        $file = __DIR__ . '/../storage/' . $file;

        if (!file_exists($file)) {
            throw new \Exception('File Not Found', 404);
        }

        return file_get_contents($file, true);
    }
}
