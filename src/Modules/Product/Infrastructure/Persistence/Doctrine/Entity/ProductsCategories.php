<?php

namespace App\Modules\Product\Infrastructure\Persistence\Doctrine\Entity;

use App\Modules\Product\Domain\Category;
use App\Modules\Product\Domain\Product;

class ProductsCategories
{
    public function __construct(
        protected Product $product,
        protected Category $category,
        protected bool $isPrincipalCategory)
    {
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function category(): Category
    {
        return $this->category;
    }

    public function isPrincipalCategory(): bool
    {
        return $this->isPrincipalCategory;
    }
}

