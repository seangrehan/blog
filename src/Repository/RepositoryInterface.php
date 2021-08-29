<?php

declare(strict_types=1);

namespace BusinessLogic\Repository;

interface RepositoryInterface
{
    public function getArticle(int $id): array;
}
