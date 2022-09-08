<?php

namespace App\Modules\Product\Domain;

use App\Modules\Shared\Domain\Id;
use App\Modules\Shared\Domain\SimpleString;

class Category
{
    protected Id $id;
    protected SimpleString $name;

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): SimpleString
    {
        return $this->name;
    }
}
