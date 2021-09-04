<?php

declare(strict_types=1);

namespace BusinessLogic;

use BusinessLogic\Repository\RepositoryInterface;
use BusinessLogic\Ads\AdsInjectorInterface;
use BusinessLogic\Ads\AdsTrait;
use BusinessLogic\Ads\Widgets\PointsTrait;

class BusinessLogic
{
    public function __construct(
        private RepositoryInterface $repository,
        private AdsInjectorInterface $adsInjector
    ) {
    }

    public function start(int $articleId): object
    {
        $contentType = 'Content-Type: application/json; charset=utf-8';
        $httpCode = 200;

        $advert = AdsTrait::get();
        $points = PointsTrait::get();

        // Go to my database of choice get an article
        try {
            // This article should contain some ads widgets in i
            $article = $this->repository->getArticle($articleId);

            // Now the fun starts, injecting ads into this article
            $article = $this->adsInjector->inject($article, $advert, $points);
        } catch (\Exception $exception) {
            $httpCode = $exception->getCode();
            $article = 'Article Not Found';
        }

        $article = json_encode($article);

        return (object) ['article' => $article, 'contentType' => $contentType, 'httpCode' => $httpCode];
    }
}
