<?php

declare(strict_types=1);

namespace BusinessLogic\Tests\Feature\Repository;

use BusinessLogic\Repository\Repository;
use BusinessLogic\Tests\Database\Mock\ArticleMock;
use PHPUnit\Framework\TestCase;

/**
 * @uses BusinessLogic\Repository\Repository::__construct
 * @uses BusinessLogic\Tests\Database\Mock\ArticleMock::__construct
 */
class RepositoryTest extends TestCase
{
    private $repository;

    public function setUp(): void
    {
        $storage = new ArticleMock();
        $this->repository = new Repository($storage);
    }

    /**
     * @covers BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Tests\Database\Mock\ArticleMock::get
     */
    public function testGetArticleHealthyIsArray(): void
    {
        $article = $this->repository->getArticle(1);

        $this->assertIsArray($article);
    }

    /**
     * @covers BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Tests\Database\Mock\ArticleMock::get
     */
    public function testGetArticleHealthyHasWidgetsKey(): void
    {
        $article = $this->repository->getArticle(1);

        $this->assertArrayHasKey('widgets', $article);
    }

    /**
     * @covers BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Tests\Database\Mock\ArticleMock::get
     */
    public function testGetArticleTruncated(): void
    {
        $this->expectException(\Exception::class);

        $this->repository->getArticle(2);
    }

    /**
     * @covers BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Tests\Database\Mock\ArticleMock::get
     */
    public function testGetArticleEmpty(): void
    {
        $this->expectException(\Exception::class);

        $this->repository->getArticle(3);
    }

    /**
     * @covers BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Tests\Database\Mock\ArticleMock::get
     */
    public function testGetArticleNoWidgetsKey(): void
    {
        $article = $this->repository->getArticle(4);

        $this->assertIsArray($article);
    }

    /**
     * @covers BusinessLogic\Repository\Repository::getArticle
     * @uses BusinessLogic\Tests\Database\Mock\ArticleMock::get
     */
    public function testGetArticleMissing(): void
    {
        $this->expectException(\Exception::class);

        $this->repository->getArticle(0);
    }
}
