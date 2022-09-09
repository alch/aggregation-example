<?php

namespace App\Modules\Product\Infrastructure\Persistence\Doctrine;

use App\Modules\Product\Domain\Category;
use App\Modules\Shared\Infrastructure\Persistence\Attribute\AsManagedEntity;
use App\Modules\Shared\Infrastructure\Persistence\Doctrine\AggregateDoctrineRepository;

#[AsManagedEntity(entityClassName: Category::class)]
class CategoryDoctrineRepository extends AggregateDoctrineRepository
{
}
