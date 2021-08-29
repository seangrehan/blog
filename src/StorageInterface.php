<?php

declare(strict_types=1);

namespace BusinessLogic;

interface StorageInterface
{
    public function get(string $file): string;
}
