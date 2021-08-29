<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Feature;

use PHPUnit\Framework\TestCase;
use BusinessLogic\Storage;

/**
 * @covers BusinessLogic\Storage
 */
class StorageTest extends TestCase
{
    private $storage;

    public function setUp(): void
    {
        $this->storage = new Storage();
    }

    public function testGetExistingFile()
    {
        $file = $this->storage->get('/../tests/storage/articles/healthy.json');

        $this->assertIsString($file);
    }

    public function testGetMissingFile()
    {
        $this->expectException(\Exception::class);

        $this->storage->get('/../tests/storage/articles/.json');
    }
}
