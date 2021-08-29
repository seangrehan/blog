<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Feature\Repository;

use PHPUnit\Framework\TestCase;
use BusinessLogic\Repository\Repository;
use BusinessLogic\Tests\Database\Mock\ArticleMock;

/**
 * @covers BusinessLogic\Repository\Repository
 * @uses BusinessLogic\Tests\Database\Mock\ArticleMock
 */
class RepositoryTest extends TestCase
{
    private $repository;

    public function setUp(): void
    {
        $storage = new ArticleMock();
        $this->repository = new Repository($storage);
    }

    public function testGetArticleHealthyIsArray(): void
    {
        $article = $this->repository->getArticle(1);

        $this->assertIsArray($article);
    }

    public function testGetArticleHealthyHasWidgetsKey(): void
    {
        $article = $this->repository->getArticle(1);

        $this->assertArrayHasKey('widgets', $article);
    }

    public function testGetArticleTruncated(): void
    {
        $this->expectException(\Exception::class);

        $this->repository->getArticle(2);
    }

    public function testGetArticleEmpty(): void
    {
        $this->expectException(\Exception::class);

        $this->repository->getArticle(3);
    }

    public function testGetArticleNoWidgetsKey(): void
    {
        $article = $this->repository->getArticle(4);

        $this->assertIsArray($article);
    }

    public function testGetArticleMissing(): void
    {
        $this->expectException(\Exception::class);

        $this->repository->getArticle(5);
    }
}
