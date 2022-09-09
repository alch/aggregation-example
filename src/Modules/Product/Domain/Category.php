<?php

namespace App\Modules\Product\Domain;

use App\Modules\Product\Domain\Event\CategoryWasCreated;
use App\Modules\Shared\Domain\Aggregate;
use App\Modules\Shared\Domain\Id;
use App\Modules\Shared\Domain\SimpleString;

class Category extends Aggregate
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

    static public function create(
        Id $id,
        SimpleString $name
    ): static {
        $self = new static();

        $self->recordThat(new CategoryWasCreated($id, $name));

        return $self;
    }

    protected function applyCategoryWasCreated(CategoryWasCreated $event): void
    {
        $this->id = $event->id();
        $this->name = $event->name();
    }

}
