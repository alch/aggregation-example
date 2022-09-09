<?php

namespace App\Modules\Shared\Domain;

interface AggregateRepository
{
    public function byId(Id $id): Aggregate;

    public function add(Aggregate $aggregate): void;

    public function remove(Aggregate $aggregate): void;
}
