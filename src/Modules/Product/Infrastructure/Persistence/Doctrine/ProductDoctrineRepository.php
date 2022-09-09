<?php

namespace App\Modules\Product\Infrastructure\Persistence\Doctrine;

use App\Modules\Product\Domain\Product;
use App\Modules\Shared\Infrastructure\Persistence\Attribute\AsManagedEntity;
use App\Modules\Shared\Infrastructure\Persistence\Doctrine\AggregateDoctrineRepository;

#[AsManagedEntity(entityClassName: Product::class)]
class ProductDoctrineRepository extends AggregateDoctrineRepository
{
}
