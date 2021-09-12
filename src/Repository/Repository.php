<?php

declare(strict_types=1);

namespace BusinessLogic\Repository;

use BusinessLogic\StorageInterface;

class Repository implements RepositoryInterface
{
    public function __construct(
        private readonly StorageInterface $storage
    ) {
    }

    public function getArticle(int $id): array
    {
        // I am pretending to be a database, getting articles by id
        $json = $this->storage->get('/articles/' . $id . '.json');

        $file = json_decode($json, true);

        if (!$file) {
            throw new \Exception('File Not Found', 404);
        }

        return $file;
    }
}
