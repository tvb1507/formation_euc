<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Category;

class CategoryDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface, ItemDataProviderInterface
{
    private $categories;

    public function __construct()
    {
        $cat1 = new Category();
        $cat1->id = 1;
        $cat1->name = 'Eaux';

        $cat2 = new Category();
        $cat2->id = 2;
        $cat2->name = 'Sodas';

        $this->categories[1] = $cat1;
        $this->categories[2] = $cat2;
    }

    public function getCollection(string $resourceClass, string $operationName = null)
    {
        return $this->categories;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        return $this->categories[$id] ?? null;
    }


    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return false;
//        return $resourceClass === Category::class;
    }
}
