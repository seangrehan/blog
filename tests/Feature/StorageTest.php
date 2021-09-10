<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Feature;

use BusinessLogic\Storage;
use PHPUnit\Framework\TestCase;

class StorageTest extends TestCase
{
    private $storage;

    public function setUp(): void
    {
        $this->storage = new Storage();
    }

    /**
     * @covers BusinessLogic\Storage::get
    */
    public function testGetExistingFile()
    {
        $file = $this->storage->get('/../tests/storage/articles/healthy.json');

        $this->assertIsString($file);
    }

    /**
     * @covers BusinessLogic\Storage::get
    */
    public function testGetMissingFile()
    {
        $this->expectException(\Exception::class);

        $this->storage->get('/../tests/storage/articles/.json');
    }
}
