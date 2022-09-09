<?php

namespace App\Modules\Product\Domain\Event;

use App\Modules\Shared\Domain\Event\Event;
use App\Modules\Shared\Domain\Id;
use App\Modules\Shared\Domain\SimpleString;

class ProductWasCreated extends Event
{
    public function __construct(
        protected Id $productId,
        protected SimpleString $name
    )
    {
        parent::__construct();
    }

    public function id(): Id
    {
        return $this->productId;
    }

    public function name(): SimpleString
    {
        return $this->name;
    }
}
