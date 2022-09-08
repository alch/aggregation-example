<?php

namespace App\Modules\Product\Domain;

use App\Modules\Shared\Domain\Id;
use App\Modules\Shared\Domain\SimpleString;

class Product
{
    protected Id $id;
    protected SimpleString $name;
    /** @var list<Category> */
    protected iterable $categories;

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): SimpleString
    {
        return $this->name;
    }

    public function categories(): iterable
    {
        return $this->categories;
    }
}
