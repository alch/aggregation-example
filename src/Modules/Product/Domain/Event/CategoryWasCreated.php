<?php

namespace App\Modules\Product\Domain\Event;

use App\Modules\Shared\Domain\Event\Event;
use App\Modules\Shared\Domain\Id;
use App\Modules\Shared\Domain\SimpleString;

class CategoryWasCreated extends Event
{
    public function __construct(
        protected Id $categoryId,
        protected SimpleString $name
    )
    {
        parent::__construct();
    }

    public function id(): Id
    {
        return $this->categoryId;
    }

    public function name(): SimpleString
    {
        return $this->name;
    }
}
