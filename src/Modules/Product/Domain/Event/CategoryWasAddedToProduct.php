<?php

namespace App\Modules\Product\Domain\Event;

use App\Modules\Shared\Domain\Event\Event;
use App\Modules\Shared\Domain\Id;

class CategoryWasAddedToProduct extends Event
{
    public function __construct(
        protected Id $productId,
        protected Id $categoryId
    )
    {
        parent::__construct();
    }

    public function productId(): Id
    {
        return $this->productId;
    }

    public function categoryId(): Id
    {
        return $this->categoryId;
    }
}
